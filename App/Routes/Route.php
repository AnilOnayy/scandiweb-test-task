<?php


// Home Page
$starter->router->get('/', 'App\Controllers\Home@index');
$starter->router->get('/addproduct', 'App\Controllers\Product@index');


$starter->router->post('/product/add', 'App\Controllers\Product@addProduct');
$starter->router->post("/product/delete",'App\Controllers\Product@deleteProduct');

$starter->router->run();

?>