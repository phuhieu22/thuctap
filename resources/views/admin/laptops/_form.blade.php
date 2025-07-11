@php
    $isEdit = $isEdit ?? false;
    $laptop = $laptop ?? null;
@endphp

<div class="row">
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>Please fix the following errors:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <!-- Basic Information -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="model" class="form-label">Model Name *</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" 
                           id="model" name="model" value="{{ old('model', $laptop->model ?? '') }}" required>
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="brand_id" class="form-label">Brand *</label>
                    <select class="form-select @error('brand_id') is-invalid @enderror" 
                            id="brand_id" name="brand_id" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" 
                                {{ old('brand_id', $laptop->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category *</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" 
                            id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $laptop->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Base Price * ($)</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" value="{{ old('price', $laptop->price ?? '') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Base Stock *</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                           id="stock" name="stock" value="{{ old('stock', $laptop->stock ?? 0) }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4">{{ old('description', $laptop->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Images & Promotions -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Images & Promotions</h5>
            </div>
            <div class="card-body">
                @if($isEdit && $laptop && $laptop->images->count() > 0)
                    <div class="mb-3">
                        <label class="form-label">Current Images</label>
                        <div class="row">
                            @foreach($laptop->images as $image)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="{{ $image->url }}" class="card-img-top" style="height: 100px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="delete_image_ids[]" value="{{ $image->id }}">
                                                <label class="form-check-label small">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="images" class="form-label">{{ $isEdit ? 'Add New Images' : 'Product Images' }}</label>
                    <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                           id="images" name="images[]" multiple accept="image/*">
                    <div class="form-text">Select multiple images (JPEG, PNG, JPG, GIF, max 2MB each)</div>
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="promotions" class="form-label">Promotions</label>
                    <select class="form-select @error('promotions') is-invalid @enderror" 
                            id="promotions" name="promotions[]" multiple>
                        @foreach($promotions as $promotion)
                            @php
                                $selectedPromotions = old('promotions', 
                                    $isEdit && $laptop ? $laptop->promotions->pluck('id')->toArray() : []
                                );
                            @endphp
                            <option value="{{ $promotion->id }}" 
                                {{ in_array($promotion->id, $selectedPromotions) ? 'selected' : '' }}>
                                {{ $promotion->name }} ({{ $promotion->discount_percentage }}% off)
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Hold Ctrl/Cmd to select multiple promotions</div>
                    @error('promotions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Variants Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Product Variants</h5>
                <button type="button" class="btn btn-outline-primary btn-sm" id="add-variant">
                    <i class="fas fa-plus"></i> Add Variant
                </button>
            </div>
            <div class="card-body">
                <div id="variants-container">
                    @if($isEdit && $laptop && $laptop->variants->count() > 0)
                        @foreach($laptop->variants as $index => $variant)
                            <div class="variant-item mb-4 p-3 border rounded" data-index="{{ $index }}">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Variant {{ $index + 1 }}</h6>
                                    <button type="button" class="btn btn-danger btn-sm remove-variant">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Variant Name *</label>
                                        <input type="text" class="form-control" name="variants[{{ $index }}][variant_name]" 
                                               value="{{ old('variants.'.$index.'.variant_name', $variant->variant_name) }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Price * ($)</label>
                                        <input type="number" step="0.01" class="form-control" name="variants[{{ $index }}][price]" 
                                               value="{{ old('variants.'.$index.'.price', $variant->price) }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Stock</label>
                                        <input type="number" class="form-control" name="variants[{{ $index }}][stock]" 
                                               value="{{ old('variants.'.$index.'.stock', $variant->stock) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Specifications</label>
                                        <textarea class="form-control" name="variants[{{ $index }}][specifications]" rows="2">{{ old('variants.'.$index.'.specifications', $variant->specifications) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="variant-item mb-4 p-3 border rounded" data-index="0">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Variant 1</h6>
                                <button type="button" class="btn btn-danger btn-sm remove-variant" style="display: none;">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Variant Name *</label>
                                    <input type="text" class="form-control" name="variants[0][variant_name]" 
                                           value="{{ old('variants.0.variant_name') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Price * ($)</label>
                                    <input type="number" step="0.01" class="form-control" name="variants[0][price]" 
                                           value="{{ old('variants.0.price') }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Stock</label>
                                    <input type="number" class="form-control" name="variants[0][stock]" 
                                           value="{{ old('variants.0.stock', 0) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Specifications</label>
                                    <textarea class="form-control" name="variants[0][specifications]" rows="2">{{ old('variants.0.specifications') }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let variantIndex = document.querySelectorAll('.variant-item').length;

    document.getElementById('add-variant').addEventListener('click', function() {
        const container = document.getElementById('variants-container');
        const newVariant = document.createElement('div');
        newVariant.className = 'variant-item mb-4 p-3 border rounded';
        newVariant.setAttribute('data-index', variantIndex);
        newVariant.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Variant ${variantIndex + 1}</h6>
                <button type="button" class="btn btn-danger btn-sm remove-variant">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Variant Name *</label>
                    <input type="text" class="form-control" name="variants[${variantIndex}][variant_name]" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Price * ($)</label>
                    <input type="number" step="0.01" class="form-control" name="variants[${variantIndex}][price]" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Stock</label>
                    <input type="number" class="form-control" name="variants[${variantIndex}][stock]" value="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Specifications</label>
                    <textarea class="form-control" name="variants[${variantIndex}][specifications]" rows="2"></textarea>
                </div>
            </div>
        `;
        container.appendChild(newVariant);
        variantIndex++;
        
        updateRemoveButtons();
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-variant')) {
            e.target.closest('.variant-item').remove();
            updateRemoveButtons();
        }
    });

    function updateRemoveButtons() {
        const variants = document.querySelectorAll('.variant-item');
        variants.forEach((variant, index) => {
            const removeBtn = variant.querySelector('.remove-variant');
            if (variants.length > 1) {
                removeBtn.style.display = 'block';
            } else {
                removeBtn.style.display = 'none';
            }
        });
    }

    // Initialize remove buttons
    updateRemoveButtons();
});
</script>
