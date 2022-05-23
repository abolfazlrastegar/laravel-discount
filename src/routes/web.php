<?php

use \Illuminate\Support\Facades\Route;
Route::group(['namespace' => '\Abolfazlrastegar\LaravelDiscount', 'middleware' => config('discount.middleware')], function () {
   Route::post('create', 'DiscountController@create');
   Route::post('edit-discount', 'DiscountController@edit');
   Route::get('remove/discount/{id}', 'DiscountController@removeDiscount');
   Route::get('discount/status', 'DiscountController@statusDiscount');
   Route::get('users/discount/{discount_id}', 'DiscountController@getUserOneDiscount')->name('users-discount');
   Route::get('discounts/user/{user_id}', 'DiscountController@getDiscountUsedUser')->name('discounts-user');
});
