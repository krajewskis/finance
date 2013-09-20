<?php

namespace Framework;

class Session
{
	static private $instance;

	private function __construct()
	{
		session_start();
	}

	public static function GetInstance()
	{
		if(!self::$instance instanceof self)
		{
			self::$instance = new Session();
		}
		return self::$instance;
	}

	public static function Set($name,$data,$serialize=false)
	{
		Session::GetInstance();
		$_SESSION[$name] = $serialize ? serialize($data) : $data;
	}

	public static function Get($name,$unserialize=false)
	{
		Session::GetInstance();

		if(isset($_SESSION[$name]))
		{
			return $unserialize ? unserialize($_SESSION[$name]) : $_SESSION[$name];
		}
	}
	
	public static function GetId()
	{
		Session::GetInstance();
		return session_id();
	}
	
	public static function Destroy()
	{
		Session::GetInstance();
		return session_destroy();
	}
}

?>