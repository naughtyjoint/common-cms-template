<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'letter',
        'amount',
        'price',
        'hex',
        'status',
    ];

    protected static function booted()
    {
        static::deleted(function ($discount) {
            foreach($discount->items as $item) {
                $item->group_id = null;
                $item->save();
            }
        });
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'group_id');
    }
}
