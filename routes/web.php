<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return " First Small laraval lumen Rest api project by sourav";
});

$router->post('/user_login', 'BackEnd\UserController@GetUserData');
$router->post('/registration', 'BackEnd\UserController@insertuserdata');
$router->post('/updateproductdata', 'BackEnd\UserController@updateuserdata');
$router->post('/deleteuserdata', 'BackEnd\UserController@deleteuserdata');


$router->get('/getallproductdata', 'BackEnd\ProductController@GetProductData');
$router->post('/catproductdata', 'BackEnd\ProductController@catproductdata');
$router->post('/insertproductdata', 'BackEnd\ProductController@insertproductdata');
$router->post('/updateproductdata', 'BackEnd\ProductController@updateproductdata');
$router->post('/deleteproductdata', 'BackEnd\ProductController@deleteproductdata');


$router->get('/getallcategory', 'BackEnd\CategoryController@GetCategoryData');
$router->post('/savecategory', 'BackEnd\CategoryController@savecategory');
$router->post('/updatecategory', 'BackEnd\CategoryController@updatecategory');
$router->post('/deletecategory', 'BackEnd\CategoryController@deletecategory');


$router->get('/getorderdata', 'BackEnd\OrderController@GetOrderData');
$router->post('/placedorder', 'BackEnd\OrderController@placedorder');

$router->get('/vieworder/{user_id}', 'BackEnd\OrderController@vieworder');

$router->get('/getallsliders', 'BackEnd\SliderController@GetSliderData');
$router->post('/saveslider', 'BackEnd\SliderController@SaveSliderData');
$router->post('/updateslider', 'BackEnd\SliderController@UpdateSliderData');
$router->post('/deleteslider', 'BackEnd\SliderController@DeleteSliderData');



