<?php namespace App\Http\Controllers\Api;

use Response;

class PlaceController extends AbstractController 
{
	public function show($id)
	{
		return Response::json($this->yp->getListingDtail($id));
	}
}