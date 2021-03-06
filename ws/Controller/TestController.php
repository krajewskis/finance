<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 29.8.13
 * Time: 10:21
 * To change this template use File | Settings | File Templates.
 */

namespace Controller;
use DTO\TestDTO;
use Framework\JSON;

/**
 * @Controller
 * @RequestMapping("/test")
 */
class TestController
{
	/**
	 * @RequestMapping(value = "/", method = POST)
	 */
	public function create(TestDTO $dto)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $dto));
	}

	/**
	 * @RequestMapping(value = "/:id", method = GET)
	 */
	public function read($id)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $id));
		$dto = new TestDTO();
		$dto->setId($id);
		return $dto;
	}

	/**
	 * @RequestMapping(value = "/:id", method = PUT)
	 */
	public function update(TestDTO $dto)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $dto));
	}

	/**
	 * @RequestMapping(value = "/:id", method = DELETE)
	 */
	public function delete($id)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $id));
	}

	/**
	 * @RequestMapping(value = "/", method = GET)
	 */
	public function listAll()
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => null));
	}
}