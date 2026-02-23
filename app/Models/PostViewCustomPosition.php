<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViewCustomPosition extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','creator_id','position_number','post_type_id'];
}
