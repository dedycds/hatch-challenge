<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Response;

class SearchController extends AbstractController
{
	public function index(Request $request)
	{
		return Response::json($request,200);
	}
}