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
	private $curl;
	private $data;
	private $method;

	private $result;
	private $info;

	public function __construct($url)
	{
		$this->url = $url;
	}

	public function doGet()
	{
		$this->curl = curl_init($this->url);
		$this->process();
	}

	public function doGetId($id)
	{
		$this->curl = curl_init($this->url . $id);
		$this->process();
	}

	public function doPost($data)
	{
		$this->curl = curl_init($this->url);
		curl_setopt($this->curl, CURLOPT_POST, true);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
		$this->process();
	}

	public function doPut($id, $data)
	{
		$this->curl = curl_init($this->url . $id);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
		$this->process();
	}

	public function doRemove($id)
	{
		$this->curl = curl_init($this->url . $id);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
		$this->process();
	}

	private function process()
	{
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		$this->result = curl_exec($this->curl);
		$this->info = curl_getinfo($this->curl);
	}

	public function closeCurl()
	{
		curl_close($this->curl);
	}

	public function getResult()
	{
		return json_decode($this->result);
	}

	public function getResultData()
	{
		return $this->getResult()->data;
	}

	public function getInfo()
	{
		return $this->info;
	}
}