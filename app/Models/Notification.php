<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'inventory_id',
        'type',
        'is_read',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
