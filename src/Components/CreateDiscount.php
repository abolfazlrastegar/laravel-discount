<?php

namespace Abolfazlrastegar\LaravelDiscount\Components;

use Abolfazlrastegar\LaravelDiscount\DiscountController;
use Illuminate\View\Component;

class CreateDiscount extends Component
{
    public function render()
    {
        return view('discount::components.create-discount', [
            'discounts' => DiscountController::getDiscount()
        ]);
    }
}
