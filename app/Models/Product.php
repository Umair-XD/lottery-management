<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'prize_amount',
        'duration_phrase',
        'bg_color',
        'image_url',
        'draw_date',
    ];

    protected $casts = [
        'draw_date' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->bg_color)) {
                $palette = [
                    '#62c9d6', // teal
                    '#0D2657', // navy
                    '#E91F1C', // red
                    '#F9A825', // amber
                    '#8BC34A', // light green
                    '#FF5722', // deep orange
                    '#9C27B0', // purple
                    '#3F51B5', // indigo
                    '#FF9800', // orange
                    '#4CAF50', // green
                    '#2196F3', // blue
                    '#3b8fa8', // light blue
                ];
                $product->bg_color = $palette[array_rand($palette)];
            }
        });
    }
}
