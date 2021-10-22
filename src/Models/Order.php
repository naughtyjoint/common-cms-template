<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'order_detail',
        'discount',
        'price',
        'payment',
    ];

    public function getCustomerAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getOrderDetailTextAttribute()
    {

        $result = json_decode($this->order_detail, true)['data'];
        $data = collect($result)->map(function ($val) {
            return $val['name'] . " / NT$" . $val['price'] . " * " . $val['amount'];
        });
        return $data;
    }
}
