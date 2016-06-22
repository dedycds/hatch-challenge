<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\YPService;

abstract class AbstractController extends Controller 
{
	/**
	 * @var App\Services\YPService
	 */
	protected $yp; 

	public function __construct(YPService $yp)
	{
		$this->yp = $yp;
	}

}