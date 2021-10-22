<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'portion',
        'price',
        'type_id',
        'group_id',
        'status'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'group_id', 'id');
    }
}
