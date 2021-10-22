<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sort',
        'ship_sort',
    ];

    protected static function booted()
    {
        static::deleted(function ($type) {
            foreach($type->items as $item) {
                $item->type_id = null;
                $item->save();
            }
        });
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
