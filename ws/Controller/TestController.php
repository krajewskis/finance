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
 * @Path (value="/test")
 */
class TestController
{
	/**
	 * @RequestMapping (value = "/", method = POST)
	 */
	function create(TestDTO $dto)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $dto));
	}

	/**
	 * @RequestMapping (value = "/:id", method = GET)
	 */
	function read($id)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $id));
		$dto = new TestDTO();
		$dto->setId($id);
		return $dto;
	}

	/**
	 * @RequestMapping (value = "/:id", method = PUT)
	 */
	function update(TestDTO $dto)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $dto));
	}

	/**
	 * @RequestMapping (value = "/:id", method = DELETE)
	 */
	function delete($id)
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => $id));
	}

	/**
	 * @RequestMapping (value = "/", method = GET)
	 */
	function listAll()
	{
		JSON::getInstance()->setMessage(array('server' => $_SERVER, 'method' => __METHOD__, 'params' => null));
	}
}