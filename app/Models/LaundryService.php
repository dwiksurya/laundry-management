<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    /**
     * Fillable Columns
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'name', 'price', 'type'
    ];

    /**
     * Relasi ke tabel orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'laundry_service_id', 'id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($data) {
            $data->branch_id = auth()->user()->branch_id;
        });
    }
}

