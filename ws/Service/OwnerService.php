<?php

namespace Service;

use DAO\OwnerDAO;
use DTO\OwnerDTO;
use Mapper\OwnerMapper;
use Model\Owner;

class OwnerService extends AbstractService
{

	function __construct()
	{
		parent::__construct('Model\Owner', 'DTO\OwnerDTO', new OwnerDAO, new OwnerMapper);
	}

	function create(OwnerDTO $dto)
	{
		$entity = new $this->model;
		$this->mapper->entity($dto, $entity);

		$entity->setPassword($this->cryptPassword($dto->getPassword()));

		$this->dao->persist($entity);
		$dto->setId($entity->getId());
	}

	function auth($email, $password)
	{
		$entity = $this->dao->findByEmail($email);

		return $entity instanceof Owner && crypt($password, $entity->getPassword()) == $entity->getPassword();
	}

	function changePassword($id, $password)
	{
		$entity = $this->dao->findById($id);
		$entity->setPassword($this->cryptPassword($password));
		$this->dao->flush($entity);
	}

	private function cryptPassword($password)
	{
		return crypt($password);
	}
}