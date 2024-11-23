<?php

use Illuminate\Support\Facades\Route;

// Home Page Route
Route::get('/', function () {
    return view('welcome'); // Returns the 'welcome' view
})->name('home');

});
