<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'user_id',
    'address_id',
    'order_number',
    'total_amount',
    'order_status',
    'payment_id',
  ];
}
