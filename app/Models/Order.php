<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'billing_address' => 'array',
        'shipping_address' => 'array',
        'order_details' => 'array',
    ];

    protected $fillable = [
        // 'invoice_id',
        'order_id',
        'billing_address',
        'shipping_address',
        'order_details',
        'sub_total',
        'discount',
        'total',
        'customer_id',
        'status',
        'delivery_charge'
    ];

    /**
     * Get the customer that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
