#Laravel discount package


### Install package for laravel 7+
```bash
  composer require abolfazlrastegar/laravel-discount
````

### Publish provider and run migrations
```bash
 php artisan vendor:publish --provider="Abolfazlrastegar\LaravelDiscount\Provider\DiscountServiceProvider" 
 
 php artisan migrate
```

### Call component view
```bash
 <x-Discount-create-discount></x-discount-create-discount>  
```
### call js and css
```bash
@stack('head') // copy paste at tag head layout html  

 @stack('footer') // copy paste at last page layout html
```
### Usage
```bash
DiscountController::create(Request $request); // Create one code discount 

DiscountController::edit(Request $request); // edit one code discount

DiscountController::getDiscount(); // Show all discount created

DiscountController::validationDiscount('code', 1) // Validation discount code used user

DiscountController::historyDiscount(8, Auth::id(), 'wallet'); // Save report used discount codes

DiscountController::getDiscountUsedUser(Auth::id()); // Show discount codes one user used

DiscountController::getUserOneDiscount(8); // Show users one code discount used

DiscountController::removeDiscount(8); // Delete one discount created

DiscountController::statusDiscount(8); // Switching status one code discount
```
