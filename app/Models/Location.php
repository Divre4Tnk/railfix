<?php

namespace App\Models;

use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'locations';

    protected $fillable = ['name'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // public function getRouteKeyName()
    // {
    //     return 'id';
    // }
}
