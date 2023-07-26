<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Egulias\EmailValidator\Parser\Comment;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// use Illuminate\Database\Eloquent\Relations\MorphMany;
// use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'media',
        'price',
        'old_price',
        'cost',
        'sku',
        'barcode',
        'quantity',
        'security',
        'is_visible',
        'published_at',
        'brand_id',
        'category_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function Comment():MorphMany
    // {
    //     return $this->morphMany(Comment::class, 'commentable');
    // }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
