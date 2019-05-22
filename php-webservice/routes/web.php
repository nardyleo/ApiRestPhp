<?php

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


//esquema de grupos de rotas para organização

// coloquei clients no plural para dizermos que estarei acessando um container de registros de clientes, tipo uma tabela de DB
$router->group([
    'prefix' => 'api/clients',
    // 'namespace' => 'App\Http\Controllers'
], function() use($router){ 
    $router->get('','ClientsController@index'); //colocar controler que vai fazer processo do get
    $router->get('{id}','ClientsController@show');
    $router->post('','ClientsController@store');  // criando elemento
    $router->put('{id}','ClientsController@update');
    $router->delete('{id}','ClientsController@destroy');
});

