<?php
return [

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
];
