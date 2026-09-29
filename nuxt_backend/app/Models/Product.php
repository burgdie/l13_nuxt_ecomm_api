<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'category_id',
    'name',
    'slug',
    'description',
    'price',
    'offer_price',
    'image',
    'stock',
    'is_fetaured',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}
