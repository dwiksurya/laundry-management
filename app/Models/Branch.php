<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * Fillable Columns
     *
     * @var array
     */
    protected $fillable = [
       'name', 'phone_number', 'address', 'description', 'status'
    ];

     /**
     * Relasi ke tabel user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'branch_id');
    }

    /**
     * Relasi ke tabel customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(Customer::class, 'branch_id');
    }

    /**
     * Relasi ke tabel laundryStaffs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laundryStaffs()
    {
        return $this->hasMany(LaundryStaff::class, 'branch_id');
    }
}
