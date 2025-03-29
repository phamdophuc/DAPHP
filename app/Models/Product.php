<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'promotion_price',
        'description',
        'image_url',
        'category_id',
        'status',
        'seo_title',
        'quantity',
        'is_hot',
        'hot_start_date',
        'hot_end_date',
        'brand_id',
        'meta_keyword',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date'
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
