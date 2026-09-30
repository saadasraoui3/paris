<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // protected $fillable = [
    //     'user_id','total','status',
    //     'payment_method','shipping_address','phone'
    // ];


protected $fillable = [
        'order_number',
        'user_id',
        'full_name',
        'email',
        'phone',
        'shipping_address',
        'city',
        'postal_code',
        'total',
        'shipping_cost',
        'status',
        'payment_method',
        'payment_status',
        'payment_reference',
        'shipping_method',
        'note',
        'paid_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at'
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
