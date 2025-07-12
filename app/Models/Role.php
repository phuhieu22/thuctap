<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Role extends Model
{
    use HasFactory; // 👉 thêm dòng này

    protected $table = 'roles';
    public $incrementing = false;

    protected $casts = [
        'id' => 'int'
    ];

    protected $fillable = [
        'name'
    ];
}
