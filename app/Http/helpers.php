<?php

function is_api(){
	$app = App::getFacadeApplication();
    $config = $app['config'];
    $request = $app['request'];
    $url = $config->get('api.base_url');
    return (strpos($request->url(), $url) === 0);
}