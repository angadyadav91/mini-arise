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
    return $router->app->version();
});

$router->group(['middleware' => 'auth', 'prefix' => 'api/'], function($router)
{

        //User cart section
        $router->post('createloan', 'LoanController@createLoan');
        $router->put('approveloan/{id}','AdminController@updateStatus');
        $router->get('getcustomerloans/{customer_id}','CustomerController@getLoanbyUserid');
        $router->post('addreypayments','CustomerController@addRepaymentbyId');
        
});