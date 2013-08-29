<?php

namespace Controller;

use Service\OwnerService;
use DTO\OwnerDTO;

/**
 * @Controller
 * @Path (value="/owner")
 */
class OwnerController {

	private $service;

	function __construct() {
		$this->service = new OwnerService;
	}

	/**
	 * @RequestMapping (value = "/", method = POST)
	 */
	function create(OwnerDTO $dto) {
		return $this->service->create($dto);
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
		return $this->service->update($dto);
	}
	/**
	 * @RequestMapping (value = "/", method = GET)
	 */
	function listAll() {
		return $this->service->listAll();
	}

}