<?php
namespace Framework;

class HttpResponse
{
	private static $instance;
	private $statusCode = 200;
	private $error;
	private $response;
	
	public static function getInstance()
	{
		if(!self::$instance instanceof self)
		{
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function setError($error,$statusCode=200)
	{
		$this->error = $error;
		$this->statusCode = $statusCode;
	}
	
	public function setJsonResponse(Json $json)
	{
		if($this->error)
		{
			$json->setError($this->error, $this->statusCode);
		}
		$this->response = $json->__toString();
	}
	
	public function send()
	{
		HttpStatusCode::getHeader($this->statusCode);
		print $this->response;
	}
}