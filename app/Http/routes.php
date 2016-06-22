<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app = App::getFacadeApplication();
$router = $app['router'];

$router->get('/', function () {
    return view('welcome');
});

$router->group(
	[
		'prefix' => 'api',
		'namespace' => 'App\Http\Controllers\Api',
		'as' => 'api::',
	], function($router) {


		$router->resource('search', 'SearchController', [
			'only' => ['index']
		]);
	}
);
