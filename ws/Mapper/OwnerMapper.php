<?php

namespace Mapper;

use Model\Owner;
use DTO\OwnerDTO;
class OwnerMapper extends AbstractMapper {

	public function dto(Owner $entity) {
		$dto = new OwnerDTO;
		$dto->setId($entity->getId());
		$dto->setEmail($entity->getEmail());
//		$dto->setPassword($entity->getPassword());
		return $dto;
	}

	public function entity(OwnerDTO $dto, Owner $entity) {
		$entity->setEmail($dto->getEmail());
//		$entity->setPassword($dto->getPassword());
	}
}