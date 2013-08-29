<?php

namespace Controller;

use Service\OwnerService;
use DTO\OwnerDTO;

/**
 * @Controller
 * @Path (value="/owner")
 */
class OwnerController extends AbstractController {

	private $service;

	function __construct() {
		$this->service = new OwnerService;
	}

	/**
	 * @RequestMapping (value = "/", method = POST)
	 */
	function create(OwnerDTO $dto) {
		$this->service->create($dto);
	}

	/**
	 * @RequestMapping (value = "/:id", method = GET)
	 */
	function read($id)
	{
		return $this->service->read($id);
	}

	/**
	 * @RequestMapping (value = "/:id", method = PUT)
	 */
	function update(OwnerDTO $dto)
	{
		$this->service->update($dto);
	}

	/**
	 * @RequestMapping (value = "/:id", method = DELETE)
	 */
	function delete($id)
	{
		$this->service->delete($id);
	}

	/**
	 * @RequestMapping (value = "/", method = GET)
	 */
	function listAll() {
		return $this->service->listAll();
	}

}