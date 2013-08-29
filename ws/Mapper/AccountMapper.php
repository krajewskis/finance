<?php

namespace Mapper;

use Model\Account;
use DTO\AccountDTO;
class AccountMapper extends AbstractMapper {

	function dto(Account $entity) {
		$dto = new AccountDTO;
		$dto->setId($entity->getId());
		$dto->setOwnerId($entity->getOwnerId());
		$dto->setIdParent($entity->getIdParent());
		$dto->setName($entity->getName());
		return $dto;
	}

	function entity(AccountDTO $dto, Account $entity) {
		$entity->setOwnerId($dto->getOwnerId());
		$entity->setIdParent($dto->getIdParent());
		$entity->setName($dto->getName());
	}
}