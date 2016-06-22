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

/**
 * Route group for front end site
 */
$router->group([
		'domian' => '',
		'namespace' => 'App\Http\Controllers',
		'as' => 'front::',
	],
	function($router){
		$router->get('/docs/{slug?}', [
			'uses' => 'DocController@display',
			'as' => 'api.doc'
		])->where([
			'slug' => '[A-Za-z0-9-]+'
		]);
	}
);


/**
 * Route group for API
 */
$router->group(
	[
		'prefix' => 'api',
		'namespace' => 'App\Http\Controllers\Api',
		'as' => 'api::',
		'middleware' => 'auth.api'
	], function($router) {

		/**
		 * route for search endpoint
		 */
		$router->resource('search', 'SearchController', [
			'only' => ['index']
		]);
		
		/**
		 * route delcaration for place
		 */
		$router->resource('places', 'PlaceController', [
			'only' => ['show']
		]);

		/**
		 * route declaration for place reviews
		 */
		$router->resource('places.reviews', 'PlaceReviewController', [
			'only' => ['index']
		]);

	}
);
