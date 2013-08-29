<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 29.8.13
 * Time: 10:17
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Controller;

use Framework\Router;
use PHPUnit_Framework_TestCase;

class TestControllerTest extends PHPUnit_Framework_TestCase
{
	const URL = 'http://localhost/finance/ws/';
	
	const ID = 1;
	const STRING = 'STRING';

	function testConnection()
	{
		$ch = curl_init(self::URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		$info = curl_getinfo($ch);

		curl_close($ch);

		$this->assertEquals('application/json', $info['content_type']);
		$this->assertEquals(400, $info['http_code']);

		$result = json_decode($result);
		$this->assertEquals(false, $result->success);
		$this->assertEquals(400, $result->statusCode);
		$this->assertEquals(Router::ERROR_WS_NOT_FOUND, $result->message);
	}

	function testGet()
	{
		$ch = curl_init(self::URL . '?/test/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		$info = curl_getinfo($ch);

		$result = json_decode($result);

		$this->assertEquals('Controller\TestController::listAll', $result->data->method);
		$this->assertEquals(null, $result->data->data);
		$this->assertEquals('GET', $result->data->server->REQUEST_METHOD);
	}

	function testGetId()
	{
		$ch = curl_init(self::URL . '?/test/'.self::ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		$info = curl_getinfo($ch);

		$result = json_decode($result);

		$this->assertEquals('Controller\TestController::read', $result->data->method);
		$this->assertEquals(self::ID, $result->data->data);
		$this->assertEquals('GET', $result->data->server->REQUEST_METHOD);
	}

	function testPost()
	{
		$ch = curl_init(self::URL . '?/test/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);

		$data = array('test' => self::STRING);
		$data = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$result = curl_exec($ch);

		$result = json_decode($result);

		$this->assertEquals('Controller\TestController::create', $result->data->method);
		$this->assertEquals(self::STRING, $result->data->data->test);
		$this->assertEquals('POST', $result->data->server->REQUEST_METHOD);
	}

	function testPut()
	{
		$ch = curl_init(self::URL . '?/test/'.self::ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

		$data = array('test' => self::STRING);
		$data = json_encode($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data)));

		$result = curl_exec($ch);

		$result = json_decode($result);

		$this->assertEquals('Controller\TestController::update', $result->data->method);
		$this->assertEquals(self::STRING, $result->data->data->test);
		$this->assertEquals('PUT', $result->data->server->REQUEST_METHOD);
	}

	function testDelete()
	{
		$ch = curl_init(self::URL . '?/test/'.self::ID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		$result = curl_exec($ch);

		$result = json_decode($result);

		$this->assertEquals('Controller\TestController::delete', $result->data->method);
		$this->assertEquals(self::ID, $result->data->data);
		$this->assertEquals('DELETE', $result->data->server->REQUEST_METHOD);
	}
}