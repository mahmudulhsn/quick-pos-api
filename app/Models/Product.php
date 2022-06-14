<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'quantity',
        'price'
    ];

    protected $appends = ['admin_url', 'thumbnail_url'];

    public function getAdminUrlAttribute()
    {
        return $this->getFirstMediaUrl('product-image', 'product-admin');
    }
    public function getThumbnailUrlAttribute()
    {
        return $this->getFirstMediaUrl('product-image', 'product-thumbnail');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-image')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('product-admin')
                    ->width(100)
                    ->height(200);

                $this->addMediaConversion('product-thumbnail')
                    ->width(590)
                    ->height(590);
            });
    }
}
