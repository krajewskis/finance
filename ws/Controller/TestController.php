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
		return array('server' => $_SERVER, 'data' => $dto, 'method' => __METHOD__);
	}

	/**
	 * @RequestMapping (value = "/:id", method = GET)
	 */
	function read($id)
	{
		return array('server' => $_SERVER, 'data' => $id, 'method' => __METHOD__);
	}

	/**
	 * @RequestMapping (value = "/:id", method = PUT)
	 */
	function update(TestDTO $dto)
	{
		return array('server' => $_SERVER, 'data' => $dto, 'method' => __METHOD__);
	}

	/**
	 * @RequestMapping (value = "/:id", method = DELETE)
	 */
	function delete($id)
	{
		return array('server' => $_SERVER, 'data' => $id, 'method' => __METHOD__);
	}

	/**
	 * @RequestMapping (value = "/", method = GET)
	 */
	function listAll()
	{
		return array('server' => $_SERVER, 'data' => null, 'method' => __METHOD__);
	}
}