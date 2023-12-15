<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * Fillable Columns
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'name', 'phone_number'
    ];

    /**
     * Relasi ke tabel orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
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
