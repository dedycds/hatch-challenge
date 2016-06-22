<?php namespace App\Http\Controllers\Api;

use Response;

class PlaceReviewController extends AbstractController
{
	public function index($placeId)
	{
		return Response::json($this->yp->getReviews($placeId));
	}
} 