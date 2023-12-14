<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Fillable Columns
     *
     * @var array
     */
    protected $fillable = [
        'branch_id',
        'customer_id',
        'laundry_staff_id',
        'laundry_service_id',
        'order_code',
        'order_date',
        'amount',
        'total',
        'payment_status',
        'payment_at',
        'order_status',
        'taken_at',
    ];

    /**
     * Relasi ke tabel customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relasi ke tabel laundry service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laundryService()
    {
        return $this->belongsTo(LaundryService::class, 'laundry_service_id');
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
            $data->laundry_staff_id = auth()->user()->staff_id;
            $data->branch_id = auth()->user()->branch_id;
            $data->order_code = self::generateOrderCode();
            $data->order_status = 'process';
        });
    }

    /**
     * Generate Random Code
     *
     * @return void
     */
    private static function generateOrderCode()
    {
        // You can customize the order code generation logic here
        // For example, using timestamp and a random string
        return time() . '-' . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
    }
}
