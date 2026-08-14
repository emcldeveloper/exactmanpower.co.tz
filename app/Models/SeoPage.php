<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
        protected $fillable = [
        'page_key',
        'title',
        'description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'is_active',
    ];

    protected $casts = [
        
        'is_active' => 'boolean',
    ];
}
