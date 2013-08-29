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

	function __construct() {
		$this->service = new AccountService;
	}

	/**
	 * @RequestMapping (value = "/", method = POST)
	 */
	function create(AccountDTO $dto) {
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
	function update(AccountDTO $dto)
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