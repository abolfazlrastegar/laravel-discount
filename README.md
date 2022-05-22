#Laravel discount package

You can use this to create a discount code and it displays the discount code and deactivates editing and uses bootstrap for the template

![alt text](https://github.com/abolfazlrastegar/laravel-discount/discount.png?raw=true)

### Install package for laravel 7+
```bash
  composer require abolfazlrastegar/laravel-discount
````

### Publish provider and run migrations
```bash
 php artisan vendor:publish --provider="Abolfazlrastegar\LaravelDiscount\Provider\DiscountServiceProvider" --force 
 
 php artisan migrate
```

### Call component view
```bash
 <x-Discount-create-discount></x-discount-create-discount>  
```
### Call js and css
```bash
@stack('head') // copy paste at tag head layout html  

 @stack('footer') // copy paste at last page layout html
```
### Config 
```bash
    "paginate" => "40",

    "layouts" => 'welcome', // set html layouts projects 

    "prefix_database" => "", // If you have a database prefix

    "url" => [
        "prefix" => 'admin', If you have a url prefix
        "discounts-user" => 'discounts/user', // route show code discounts one user 
        "users_discount" => 'users/discount' // route show users one code discount
    ],
    
     // if you used from files for themes website == false
    "file" => [
       "display" => [
           "bootstrap-css" => true,
           "bootstrap-js" => true,
           "persianDatepicker-default" => true,
           "persianDatepicker-dark" => true,
           "jquery" => true,
           "ajax" => true,
           "sweetalert2" => true,
           "persianDatepicker-js" => true,
       ]
    ]
```
### Usage
```bash
DiscountController::create(Request $request); // Create one code discount 

DiscountController::edit(Request $request); // edit one code discount

DiscountController::getDiscount(); // Show all discount created

DiscountController::validationDiscount('code', Auth::id()) // Validation discount code used user

DiscountController::historyDiscount(8, Auth::id(), 'wallet'); // Save report used discount codes

DiscountController::getDiscountUsedUser(Auth::id()); // Show discount codes one user used

DiscountController::getUserOneDiscount(8); // Show users one code discount used

DiscountController::removeDiscount(8); // Delete one discount created

DiscountController::statusDiscount(8); // Switching status one code discount
```
