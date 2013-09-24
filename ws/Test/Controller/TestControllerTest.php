<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 29.8.13
 * Time: 10:17
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Controller;

use Framework\CURL;
use Framework\Application;
use PHPUnit_Framework_TestCase;

class TestControllerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var CURL
	 */
	private $curl;

	const URL = 'http://localhost/finance/ws/?/test';

	const ID = 1;
	const STRING = 'STRING';

	public function setUp()
	{
		$this->curl = new CURL(self::URL);
	}

	public function testGet()
	{
		$this->curl = new CURL(self::URL);
		$this->curl->doGet();

		$result = $this->curl->getResult();

		$this->assertEquals('Controller\TestController::listAll', $result->message->method);
		$this->assertNull($result->data);
		$this->assertEquals('GET', $result->message->server->REQUEST_METHOD);
	}

	public function testGetId()
	{
		$this->curl->doGetId(self::ID);

		$result = $this->curl->getResult();

		$this->assertEquals('Controller\TestController::read', $result->message->method);
		$this->assertEquals(self::ID, $result->data->id);
		$this->assertEquals('GET', $result->message->server->REQUEST_METHOD);
	}

	public function testPost()
	{
		$data = array('test' => self::STRING);
		$data = json_encode($data);

		$this->curl->doPost($data);

		$result = $this->curl->getResult();

		$this->assertEquals('Controller\TestController::create', $result->message->method);
		$this->assertEquals(self::STRING, $result->data->test);
		$this->assertEquals('POST', $result->message->server->REQUEST_METHOD);
	}

	public function testPut()
	{
		$data = array('test' => self::STRING);
		$data = json_encode($data);

		$this->curl->doPut(self::ID, $data);

		$result = $this->curl->getResult();

		$this->assertEquals('Controller\TestController::update', $result->message->method);
		$this->assertEquals(self::STRING, $result->data->test);
		$this->assertEquals('PUT', $result->message->server->REQUEST_METHOD);
	}

	public function testDelete()
	{
		$this->curl->doDelete(self::ID);

		$result = $this->curl->getResult();

		$this->assertEquals('Controller\TestController::delete', $result->message->method);
		$this->assertNull($result->data);
		$this->assertEquals('DELETE', $result->message->server->REQUEST_METHOD);
	}
}