<?php namespace App\Http\Controllers;

use Michelf\MarkdownExtra;

class DocController extends Controller 
{
	private static $basepath;

	public function __construct()
	{
		static::$basepath = __DIR__.'/../../../docs/';
	}

	public function display($slug = 'main')
	{ 
		
		$file = static::$basepath . "{$slug}.md";
		if(file_exists($file))
		{
			$markdown = new MarkdownExtra;
			$files = file_get_contents($file);
			$html = $markdown->transform($files);

			return view('docs.index', compact('html'));
		}
		\App::abort(404);

	}

}