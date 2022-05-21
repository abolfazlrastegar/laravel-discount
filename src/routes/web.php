<?php

use \Illuminate\Support\Facades\Route;
Route::namespace('\Abolfazlrastegar\LaravelDiscount')->group(function () {
   Route::post('create', 'DiscountController@create');
   Route::get('remove/discount/{id}', 'DiscountController@removeDiscount');
   Route::get('discount/status', 'DiscountController@statusDiscount');
   Route::get('user-discounts', 'DiscountController@getUserOneDiscount');
});
