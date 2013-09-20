<?php

namespace Service;

use DAO\AccountDAO;
use Mapper\AccountMapper;

class AccountService extends AbstractService {

	public function __construct() {
		parent::__construct('Model\Account', 'DTO\AccountDTO', new AccountDAO, new AccountMapper);
	}
}