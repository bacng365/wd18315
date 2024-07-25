<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public $primaryKey = 'order_id'; // Mặc định là id nên không cần khai báo
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'totalPrice',
    ];
}
