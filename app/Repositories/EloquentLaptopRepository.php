<?php
namespace App\Repositories;
use App\Interfaces\LaptopRepositoryInterface;
use App\Models\Laptop;
use App\Models\LaptopVariant;
use App\Models\LaptopImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EloquentLaptopRepository implements LaptopRepositoryInterface
{
    public function getAll(array $filters = [], array $sort = [], int $perPage = 10)
    {
        $query = Laptop::with(['brand', 'category', 'images', 'variants', 'promotions']);

        // Apply filters
        $query = $this->applyFilters($query, $filters);

        // Apply sorting
        $query = $this->applySorting($query, $sort);

        // Return paginated results
        return $query->paginate($perPage);
    }

    public function searchLaptops(string $searchQuery, array $filters = [], array $sort = [], int $perPage = 10)
    {
        $query = Laptop::with(['brand', 'category', 'images', 'variants', 'promotions']);

        // Apply search across multiple fields
        $query->where(function ($q) use ($searchQuery) {
            $q->where('model', 'like', '%' . $searchQuery . '%')
              ->orWhere('description', 'like', '%' . $searchQuery . '%')
              ->orWhereHas('brand', function ($brandQuery) use ($searchQuery) {
                  $brandQuery->where('name', 'like', '%' . $searchQuery . '%');
              })
              ->orWhereHas('category', function ($categoryQuery) use ($searchQuery) {
                  $categoryQuery->where('name', 'like', '%' . $searchQuery . '%');
              })
              ->orWhereHas('variants', function ($variantQuery) use ($searchQuery) {
                  $variantQuery->where('variant_name', 'like', '%' . $searchQuery . '%')
                              ->orWhere('specifications', 'like', '%' . $searchQuery . '%');
              });
        });

        // Apply additional filters
        $query = $this->applyFilters($query, $filters);

        // Apply sorting
        $query = $this->applySorting($query, $sort);

        // Return paginated results
        return $query->paginate($perPage);
    }

    protected function applyFilters($query, array $filters)
    {
        if (!empty($filters['brand_id'])) {
            if (is_array($filters['brand_id'])) {
                $query->whereIn('brand_id', $filters['brand_id']);
            } else {
                $query->where('brand_id', $filters['brand_id']);
            }
        }

        if (!empty($filters['category_id'])) {
            if (is_array($filters['category_id'])) {
                $query->whereIn('category_id', $filters['category_id']);
            } else {
                $query->where('category_id', $filters['category_id']);
            }
        }

        if (!empty($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        if (!empty($filters['stock_min'])) {
            $query->where('stock', '>=', $filters['stock_min']);
        }

        if (!empty($filters['stock_max'])) {
            $query->where('stock', '<=', $filters['stock_max']);
        }

        if (!empty($filters['has_promotions'])) {
            if ($filters['has_promotions']) {
                $query->whereHas('promotions');
            } else {
                $query->whereDoesntHave('promotions');
            }
        }

        if (!empty($filters['promotion_ids'])) {
            $query->whereHas('promotions', function ($promotionQuery) use ($filters) {
                $promotionQuery->whereIn('promotions.id', $filters['promotion_ids']);
            });
        }

        if (!empty($filters['in_stock'])) {
            $query->where('stock', '>', 0);
        }

        if (!empty($filters['out_of_stock'])) {
            $query->where('stock', '=', 0);
        }

        if (!empty($filters['created_after'])) {
            $query->where('created_at', '>=', $filters['created_after']);
        }

        if (!empty($filters['created_before'])) {
            $query->where('created_at', '<=', $filters['created_before']);
        }

        return $query;
    }

    protected function applySorting($query, array $sort)
    {
        if (empty($sort)) {
            // Default sorting
            return $query->orderBy('created_at', 'desc');
        }

        foreach ($sort as $field => $direction) {
            $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';
            
            switch ($field) {
                case 'model':
                case 'price':
                case 'stock':
                case 'created_at':
                case 'updated_at':
                    $query->orderBy($field, $direction);
                    break;
                    
                case 'brand':
                    $query->join('brands', 'laptops.brand_id', '=', 'brands.id')
                          ->orderBy('brands.name', $direction)
                          ->select('laptops.*');
                    break;
                    
                case 'category':
                    $query->join('categories', 'laptops.category_id', '=', 'categories.id')
                          ->orderBy('categories.name', $direction)
                          ->select('laptops.*');
                    break;
                    
                case 'variants_count':
                    $query->withCount('variants')
                          ->orderBy('variants_count', $direction);
                    break;
                    
                case 'images_count':
                    $query->withCount('images')
                          ->orderBy('images_count', $direction);
                    break;
                    
                case 'promotions_count':
                    $query->withCount('promotions')
                          ->orderBy('promotions_count', $direction);
                    break;
                    
                case 'min_variant_price':
                    $query->leftJoin('laptop_variants', 'laptops.id', '=', 'laptop_variants.laptop_id')
                          ->selectRaw('laptops.*, MIN(laptop_variants.price) as min_variant_price')
                          ->groupBy('laptops.id')
                          ->orderBy('min_variant_price', $direction);
                    break;
                    
                case 'max_variant_price':
                    $query->leftJoin('laptop_variants', 'laptops.id', '=', 'laptop_variants.laptop_id')
                          ->selectRaw('laptops.*, MAX(laptop_variants.price) as max_variant_price')
                          ->groupBy('laptops.id')
                          ->orderBy('max_variant_price', $direction);
                    break;
                    
                default:
                    // Ignore unknown sort fields
                    break;
            }
        }

        return $query;
    }

    public function findById(int $id)
    {
        return Laptop::with(['brand', 'category', 'images', 'variants', 'promotions'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Extract variants and images data
            $variants = $data['variants'] ?? [];
            $images = $data['images'] ?? [];
            unset($data['variants'], $data['images']);

            // Create laptop
            $laptop = Laptop::create($data);

            // Create variants
            if (!empty($variants)) {
                foreach ($variants as $variant) {
                    $laptop->variants()->create([
                        'variant_name' => $variant['variant_name'],
                        'price' => $variant['price'],
                        'stock' => $variant['stock'] ?? 0,
                        'specifications' => $variant['specifications'] ?? null,
                    ]);
                }
            }

            // Create images
            if (!empty($images)) {
                foreach ($images as $imageUrl) {
                    $laptop->images()->create([
                        'url' => $imageUrl,
                    ]);
                }
            }

            return $laptop->load(['brand', 'category', 'images', 'variants', 'promotions']);
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $laptop = Laptop::findOrFail($id);

            // Extract variants and images data
            $variants = $data['variants'] ?? [];
            $images = $data['images'] ?? [];
            $deleteImageIds = $data['delete_image_ids'] ?? [];
            unset($data['variants'], $data['images'], $data['delete_image_ids']);

            // Update laptop
            $laptop->update($data);

            // Update variants - delete existing and create new ones
            if (!empty($variants)) {
                $laptop->variants()->delete();
                foreach ($variants as $variant) {
                    $laptop->variants()->create([
                        'variant_name' => $variant['variant_name'],
                        'price' => $variant['price'],
                        'stock' => $variant['stock'] ?? 0,
                        'specifications' => $variant['specifications'] ?? null,
                    ]);
                }
            }

            // Delete specified images
            if (!empty($deleteImageIds)) {
                LaptopImage::whereIn('id', $deleteImageIds)
                    ->where('laptop_id', $laptop->id)
                    ->delete();
            }

            // Add new images
            if (!empty($images)) {
                foreach ($images as $imageUrl) {
                    $laptop->images()->create([
                        'url' => $imageUrl,
                    ]);
                }
            }

            return $laptop->load(['brand', 'category', 'images', 'variants', 'promotions']);
        });
    }

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            $laptop = Laptop::findOrFail($id);
            
            // Delete related data
            $laptop->variants()->delete();
            $laptop->images()->delete();
            $laptop->promotions()->detach();
            
            return $laptop->delete();
        });
    }
}