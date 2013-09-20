<?php

namespace DAO;

class AccountDAO extends AbstractDAO {

	public function __construct() {
		parent::__construct('Model\Account');
	}
}