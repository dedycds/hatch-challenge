<?php

function is_api(){
	$app = App::getFacadeApplication();
    $config = $app['config'];
    $request = $app['request'];
    $url = $config->get('api.base_url');
    return (strpos($request->url(), $url) === 0);
}

function web_asset($path, $secure = false)
{
    return app('url')->asset("/assets/{$path}", $secure);
}

