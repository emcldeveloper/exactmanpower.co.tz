<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViewsAnalysis extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','visitor_ip'];
}
