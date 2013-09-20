<?php

namespace Framework;

class Json
{
	private static $instance;
	public $success = true;
	public $statusCode = 200;
	public $message;
	public $data;

	public static function getInstance()
	{
		if(!self::$instance instanceof self)
		{
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function setError($error,$statusCode)
	{
		$this->success = false;
		$this->message = $error;
		$this->statusCode = $statusCode;
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function __toString()
	{
		header('Content-type: application/json');
		return json_encode($this);
	}

	public static function decode($json)
	{
		return json_decode($json,true);
	}

}