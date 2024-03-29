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


/**
 * Routes for resource person
 */
$router->get('persons', 'PersonController@getPersons');
$router->get('person/{id}', 'PersonController@getPerson');
$router->post('person', 'PersonController@addPerson');
//$router->put('person/{id}', 'PersonController@updatePerson');
$router->get('person/family/{parent_id}', 'PersonController@getPersonFamilyTree');
