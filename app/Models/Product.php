<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name', 'sub_title', 'product_description', 'product_code', 'category_id', 'supplier_id', 'root', 'brand', 'buying_price', 'selling_price', 'discount', 'buying_date', 'product_quantity', 'cpu', 'color', 'ram', 'rom', 'display_size', 'photo', 'slug', 'status'
    ];

    /**
     * The attributes that are create relation with category.
     *
     * @var array
     */
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * The attributes that are create relation with supplier.
     *
     * @var array
     */
    public function supplier() {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }
}
