#Laravel discount package

You can use this to create a discount code and it displays the discount code and deactivates editing and uses bootstrap for the template

![alt text](https://github.com/abolfazlrastegar/laravel-discount/blob/main/discount.png?raw=true)
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
    /*
     |------------------------------------------------------
     |  paginate limit for query page
     |-------------------------------------------------------
     */
    "paginate" => "40",
     "limit" => "30",

    /*
     |------------------------------------------------------
     |  layouts html
     |-------------------------------------------------------
     */
    "layouts" => 'welcome',

    /*
     |------------------------------------------------------
     |  prefix in database
     |-------------------------------------------------------
     */
    "prefix_database" => '',

    /*
     |------------------------------------------------------
     |  namespace model
     |-------------------------------------------------------
     */
    "namespace_model_user" => \App\Models\User::class,

    /*
     |------------------------------------------------------
     |  group route
     |-------------------------------------------------------
     */
    "middleware" => ['web'],
    "prefix" => 'admin',

    /*
     |------------------------------------------------------
     | assets
     |-------------------------------------------------------
     | show file css and js if used from this file  => false
     */
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

DiscountController::historyDiscount(8, Auth::id(), 'wallet'); // Save report used discount codes

DiscountController::validationDiscount('code', Auth::id()) // Validation discount code used user

DiscountController::getDiscountUsedUser(Auth::id()); // Show discount codes one user used

DiscountController::getUserOneDiscount(8); // Show users one code discount used

DiscountController::removeDiscount(8); // Delete one discount created

DiscountController::statusDiscount(8); // Switching status one code discount
```

### result function DiscountController::validationDiscount('code', Auth::id())
```bash
//validation ok
{
  "id": 2,
  "price": 200000,
  "percent": 50
}

// user used code discount
{
  "user": true
}

// Expired period of use
{
  "date": false
}
```
