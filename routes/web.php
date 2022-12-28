<?php
use TinyRouter\Render\View;
use TinyRouter\Routes\Route;

Route::get('/', function () {
    return View::render('welcome', [
        'title' => 'Accueil'
    ]);
});

Route::get('product', function () {
    return View::render('product', [
        'title' => 'ahaha'
    ]);
});