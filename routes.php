<?php

Route::set('index.php', function() {
    HomeController::create_view('home');
});

Route::set('about', function() {
    AboutController::create_view('about');
});

Route::set('contact', function() {
    ContactController::create_view('contact');
});

Route::set('get-all-info', function() {
    ApiController::getAllInformation();
});

Route::set('insert-update-information', function() {
    ApiController::insertUpdate();
});

Route::set('delete-information', function() {
    ApiController::deleteInformation();
});