<?php namespace App\Services;

use Config;
use Guzzle\Http\Client;

class YPService {

	/**
	 * Yellow pages api key
	 * @var string
	 */
	protected $apiKey;

	/**
	 * Yellow pages api base url
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * Guzzle Client Object
	 * @var Guzzle\Http\Client
	 */
	protected $client;

	public function __construct(Client $client)
	{
		$this->apiKey = Config::get('yp.api_key');
		$this->baseUrl = Config::get('yp.url');
		$this->client = $client;
		$this->client->setBaseUrl($this->baseUrl);
	}

	/**
	 * Search lisings based on term and searchloc
	 * @param  string $term      
	 * @param  string $searchloc 
	 * @return json            
	 */
	public function search($term = '', $searchloc = '')
	{
		$uri = 'search';
		$params = [
			'term' => $term,
		];
		return $this->get($uri, $params);
	}

	/**
	 * Get listing detail by listing id
	 * @param  int $listingId 
	 * @return json            
	 */
	public function getListingDtail($listingId)
	{
		$uri = 'details';
		$params = [
			'listingid' => $listingId
		];

		return $this->get($uri, $params);
	}

	/**
	 * Get reviews on certain listing
	 * @param  int $listingId 
	 * @return json            
	 */
	public function getReviews($listingId)
	{
		$uri = 'reviews';
		$params = [
			'listingid' => $listingId
		];

		return $this->get($uri, $params);
	}

	/**
	 * method tp make a request to YP API
	 * @param  [type] $uri    [description]
	 * @param  array  $params [description]
	 * @return [type]         [description]
	 */
	private function get($uri, $params = array())
	{
		$params['key'] = $this->apiKey;
		$params['format'] = 'json'; 
		$this->client->setDefaultOption('query', $params);
		
		$request = $this->client->get($uri);
		$response = $request->send();
		return $response->json(); 
	}




}