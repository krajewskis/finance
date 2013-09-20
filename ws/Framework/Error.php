<?php

namespace Framework;

class Error
{
	public static function Init() {}
	
	public static function captureError( $number, $message, $file, $line )
	{
		switch ($number)
		{
			case E_WARNING: $type = 'WARNING'; break;
			case E_NOTICE: $type = 'NOTICE'; break;
			case E_USER_ERROR: $type = 'USER_ERROR'; break;
			case E_USER_WARNING: $type = 'USER_WARNING'; break;
			case E_USER_NOTICE: $type = 'USER_NOTICE'; break;
		}
		if($number <= 1024)
		{
			header("HTTP/1.0 406 Not Acceptable");
			header('Content-type: application/json');
			$error = array('type' => $type, 'message' => $message, 'file' => $file, 'line' => $line );
			print json_encode($error);
			exit;
		}
		return true;
	}

	public static function captureException( $exception )
	{
		header("HTTP/1.0 406 Not Acceptable");
		header('Content-type: application/json');
		print json_encode($exception);
		exit;
	}
	
	public static function captureShutdown( $exception = null )
	{
		header("HTTP/1.0 406 Not Acceptable");
		header('Content-type: application/json');
		print json_encode($exception);
		exit;
	}
	
}
?>