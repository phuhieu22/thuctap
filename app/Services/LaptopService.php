<?php
namespace App\Services;

use App\Interfaces\LaptopRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class LaptopService
{
    protected $laptopRepository;

    public function __construct(LaptopRepositoryInterface $laptopRepository)
    {
        $this->laptopRepository = $laptopRepository;
    }

    public function getAllLaptops(array $filters = [])
    {
        return $this->laptopRepository->getAll($filters);
    }

    public function getLaptopById(int $id)
    {
        return $this->laptopRepository->findById($id);
    }

    public function storeLaptop(array $data, array $images = [], array $promotionIds = [])
    {
        // Handle file uploads
        $imageUrls = $this->handleImageUploads($images);
        $data['images'] = $imageUrls;

        // Create laptop
        $laptop = $this->laptopRepository->create($data);

        // Sync promotions
        if (!empty($promotionIds)) {
            $laptop->promotions()->sync($promotionIds);
        }

        return $laptop;
    }

    public function updateLaptop(int $id, array $data, array $images = [], array $deleteImageIds = [], array $promotionIds = [])
    {
        // Get current laptop to handle image deletion
        $currentLaptop = $this->laptopRepository->findById($id);
        
        // Delete specified images from storage
        if (!empty($deleteImageIds)) {
            $imagesToDelete = $currentLaptop->images()->whereIn('id', $deleteImageIds)->get();
            foreach ($imagesToDelete as $image) {
                $this->deleteImageFromStorage($image->url);
            }
            $data['delete_image_ids'] = $deleteImageIds;
        }

        // Handle new file uploads
        $imageUrls = $this->handleImageUploads($images);
        $data['images'] = $imageUrls;

        // Update laptop
        $laptop = $this->laptopRepository->update($id, $data);

        // Sync promotions
        if (!empty($promotionIds)) {
            $laptop->promotions()->sync($promotionIds);
        }

        return $laptop;
    }

    public function deleteLaptop(int $id)
    {
        // Get laptop to delete associated images
        $laptop = $this->laptopRepository->findById($id);
        
        // Delete images from storage
        foreach ($laptop->images as $image) {
            $this->deleteImageFromStorage($image->url);
        }

        return $this->laptopRepository->delete($id);
    }

    protected function handleImageUploads(array $images): array
    {
        $imageUrls = [];

        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('laptops', $filename, 'public');
                $imageUrls[] = Storage::url($path);
            }
        }

        return $imageUrls;
    }

    protected function deleteImageFromStorage(string $url): void
    {
        $path = str_replace('/storage/', '', $url);
        Storage::disk('public')->delete($path);
    }
}