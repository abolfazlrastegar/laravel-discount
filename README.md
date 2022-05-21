#Laravel discount package


### Install package for laravel 7+
```bash
  composer require abolfazlrastegar/laravel-discount
````

### Publish and run migrations
```bash
 php artisan vendor:publish --provider="Abolfazlrastegar\LaravelDiscount\Provider\DiscountServiceProvider" --tag="migrations" 
 
 php artisan migrate
```

### Publish for customize view 
```bash
 php artisan vendor:publish --provider="Abolfazlrastegar\LaravelDiscount\Provider\DiscountServiceProvider" --tag="views" 
```

### Call components view
```bash
      //call blade create-discount for create one discount and list discount
      
     <x-Discount-create-discount data="{{$data}}"></x-discount-create-discount>
     
     // call blade history-discount for show list discount used
     
     <x-Discount-history-discount data="{{$data}}"></x-discount-history-discount>
```

### Usage
```bash
    DiscountController::create($request); // Create one discount 
    DiscountController::getDiscount(25); // Show all discount created
    DiscountController::historyDiscount(8, 'wallet'); // History used discounts
    DiscountController::getDiscountUsedUser(50); // Show discount one user used
    DiscountController::getUserOneDiscount(8); // Show user one discount used
    DiscountController::removeDiscount(8); // delete one discount created
```
