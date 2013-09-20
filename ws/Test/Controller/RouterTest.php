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

class RouterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var CURL
	 */
	private $curl;

	const URL = 'http://localhost/finance/ws/';

	public function setUp()
	{
		$this->curl = new CURL(self::URL);
	}

	public function tearDown()
	{
		$this->curl->closeCurl();
	}

	public function testConnection()
	{
		$this->curl->doGet();

		$result = $this->curl->getResult();
		$info = $this->curl->getInfo();

		$this->assertEquals('application/json', $info['content_type']);
		$this->assertEquals(400, $info['http_code']);

		$this->assertEquals(false, $result->success);
		$this->assertEquals(400, $result->statusCode);
		$this->assertEquals(Application::ERROR_WS_NOT_FOUND, $result->message);
	}
}