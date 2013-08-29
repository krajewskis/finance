<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 29.8.13
 * Time: 10:05
 * To change this template use File | Settings | File Templates.
 */

namespace Framework;


class CURL
{
	private $url;
	private $ch;
	private $data;
	private $method;

	public $result;
	public $info;

	function __construct($url, $method, $data)
	{
		$this->url = $url;
		$this->ch = curl_init(self::URL);
		$this->method = $method;
		$this->data = json_encode($data);

		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
	}

	function process()
	{
//		$data = json_encode(array('email'=>self::EMAIL,'password'=>self::PASSWORD));
//		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);

		$this->result = curl_exec($ch);
		$this->info = curl_getinfo($ch);

		curl_close($this->ch);

		return $this->result;
	}

}