<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViewType extends Model
{
    use HasFactory;
     protected $fillable = ['id','user_id','status','created_at','updated_at'];
}
