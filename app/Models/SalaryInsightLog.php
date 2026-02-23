<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryInsightLog extends Model
{
  use HasFactory;
  protected $fillable = [
    'salary_type',
    'currency',
    'period',
    'input_amount',
    'gross_amount',
    'net_amount',
    'ip_address',
    'user_agent',
    'device',
    'os',
    'browser',
    'country',
    'city',
    'hour',
    'day',

  ];
}
