<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'inventories';

    protected $fillable = [
        'code',
        'name',
        'location_id',
        'serial_number',
        'date_in',
        'date_out',
        'pic',
        'phone',
        'status',
        'description',
    ];

    public $casts = [
        'date_in' => 'date',
        'date_out' => 'date',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('code', 'desc')->first();

            $number = 1;

            if ($last && $last->code && preg_match('/WS(\d+)/', $last->code, $matches)) {
                $number = intval($matches[1]) + 1;
            }

            $model->code = 'WS' . str_pad($number, 5, '0', STR_PAD_LEFT);
        });
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
