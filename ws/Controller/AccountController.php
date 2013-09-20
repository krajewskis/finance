<?php

namespace Controller;

use Service\AccountService;
use DTO\AccountDTO;

/**
 * @Controller
 * @Path (value="/account")
 */
class AccountController {

	private $service;

	public function __construct() {
		$this->service = new AccountService;
	}

	/**
	 * @RequestMapping (value = "/", method = POST)
	 */
	public function create(AccountDTO $dto) {
		return $this->service->create($dto);
	}

	/**
	 * @RequestMapping (value = "/:id", method = GET)
	 */
	public function read($id)
	{
		return $this->service->read($id);
	}

	/**
	 * @RequestMapping (value = "/:id", method = PUT)
	 */
	public function update(AccountDTO $dto)
	{
		return $this->service->update($dto);
	}
	/**
	 * @RequestMapping (value = "/", method = GET)
	 */
	public function listAll() {
		return $this->service->listAll();
	}

}