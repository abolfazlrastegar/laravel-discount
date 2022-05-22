<?php
return [

    "paginate" => "40",

    "layouts" => 'welcome',

    "prefix_database" => "arzland_",

    "url" => [
        "prefix" => 'admin',
        "discounts-user" => 'discounts/user',
        "users_discount" => 'users/discount'
    ],

    /**
     * if you used from files for themes website == false
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
];
