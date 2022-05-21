<?php

namespace Abolfazlrastegar\LaravelDiscount\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $fillable = [
        'title',
        'quantity',
        'price',
        'start_date',
        'end_date',
        'approved'
    ];

    public function historyDiscount () {
        return $this->hasMany(HistoryDiscount::class, 'discount_id');
    }
}
