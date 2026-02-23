<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayCalculator extends Model
{
    use HasFactory;
    
    // Uncomment if you want soft delete
    // use SoftDeletes;

    /**
     * Primary key
     */
    protected $primaryKey = 'id';

    /**
     * Table name
     */
    protected $table = 'pay_calculators';

    /**
     * Enable timestamps
     */
    public $timestamps = true;

    /**
     * Mass assignable fields
     */
  
    protected $fillable = [
    'payone_reduction',
    'paytwo_reduction	',
    'paythree_reduction	',
    'payfour_reduction	',
    'paytwo_addition',
    'paythree_addition',
    'payfour_addition',
    'payone_percentage',
    'paytwo_percentage',
    'paythree_percentage',
    'payone_percentage',
    
];

     
}
