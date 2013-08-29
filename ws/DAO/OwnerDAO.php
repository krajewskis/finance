<?php

namespace DAO;

class OwnerDAO extends AbstractDAO {

	function __construct() {
		parent::__construct('Model\Owner');
	}

	public function findByEmail($email)
	{
		$entities = $this->em->findBy(array('email'=>$email));
		return isset($entities[0]) ? $entities[0] : null;
	}
}