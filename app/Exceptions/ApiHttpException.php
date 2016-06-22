<?php namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiHttpException extends HttpException {

	/**
     * Array of exception reasons
     *
     * @var array
     */
    protected $content;

    public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
    {
    	if (is_array($message)) {
            $this->content = $message;
        } else {
        	$this->content  = array($message);
        }
    	parent::__construct($statusCode, null, $previous, $headers, $code);
    }

    /**
     * get exception reasons
     * @return array
     */
    public function getContent()
    {
    	return $this->content;
    }

}