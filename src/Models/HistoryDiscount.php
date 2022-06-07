<?php

namespace Abolfazlrastegar\LaravelDiscount\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDiscount extends Model
{
    use HasFactory;
    protected $table = 'history_discounts';

    protected $fillable = [
        'discount_id',
        'user_id',
        'section_used',
        'approved'
    ];

    public function discount() {
        return $this->belongsTo(Discount::class);
    }

    public function user() {
        return $this->belongsTo(config('discount.namespace_model_user'));
    }
}
