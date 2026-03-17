<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
class SalaryUsageSummary extends Model
{
    protected $table = 'salary_usage_summary';

    protected $fillable = [
        'type',
        'view_count'
    ];

    // Optional: disable timestamps if you don't need them
    // public $timestamps = false;

    /**
     * Increment counter safely
     */
    public static function incrementType($type)
    {
        return self::where('type', $type)->increment('view_count');
    }

    /**
     * Get count by type
     */
    public static function getCount($type)
    {
        return self::where('type', $type)->value('view_count') ?? 0;
    }

    /**
     * Get total usage
     */
    public static function getTotal()
    {
        return self::sum('view_count');
    }
}
