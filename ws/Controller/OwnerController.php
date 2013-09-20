<?php

namespace Controller;

use Service\OwnerService;
use DTO\OwnerDTO;

/**
 * @Controller
 * @RequestMapping("/owner")
 */
class OwnerController extends AbstractController {

	private $service;

	public function __construct() {
		$this->service = new OwnerService;
	}

	/**
	 * @RequestMapping(value = "/", method = POST)
	 */
	public function create(OwnerDTO $dto) {
		$this->service->create($dto);
	}

	/**
	 * @RequestMapping(value = "/:id", method = GET)
	 */
	public function read($id)
	{
		return $this->service->read($id);
	}

	/**
	 * @RequestMapping(value = "/:id", method = PUT)
	 */
	public function update(OwnerDTO $dto)
	{
		$this->service->update($dto);
	}

	/**
	 * @RequestMapping(value = "/:id", method = DELETE)
	 */
	public function delete($id)
	{
		$this->service->delete($id);
	}

	/**
	 * @RequestMapping(value = "/", method = GET)
	 */
	public function listAll() {
		return $this->service->listAll();
	}

}