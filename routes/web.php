<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', action: function () {
    return view('dashbord');
});


Route::get('/users',function(){
    return view('Backend.layouts.admin.index');
});


// Route::get('/login',function(){
//     return view('backend.layouts.auth.login.login');
// });

// Route::get('/register',function(){
//     return view('backend.layouts.auth.register.register');
// });


