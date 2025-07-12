<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $casts = [
        'id' => 'int',
    ];

    protected $fillable = [
        'name',
    ];

    public function laptops(): HasMany
    {
        return $this->hasMany(Laptop::class);
    }
}
