<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Response;

class SearchController extends AbstractController
{
	public function index(Request $request)
	{
		$s = $request->get('s');
		return Response::json($this->yp->search($s, ''),200);
	}
}