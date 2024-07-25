<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orders_detail';
    public $primaryKey = 'order_detail_id'; // Mặc định là id nên không cần khai báo
    public $incrementing = true;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
}
