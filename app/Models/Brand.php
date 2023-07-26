<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_b', 'slug_b', 'web_b', 'visible_b', 'description_b',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
