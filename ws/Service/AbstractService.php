<?php

namespace Service;

use DAO\AbstractDAO;
use DTO\AbstractDTO;
use Mapper\AbstractMapper;

abstract class AbstractService {

	protected $model;
	protected $dto;
	protected $dao;
	protected $mapper;

	function __construct($model, $dto, AbstractDAO $dao, AbstractMapper $mapper) {
		$this->model = $model;
		$this->dto = $dto;
		$this->dao = $dao;
		$this->mapper = $mapper;
	}

	function create(AbstractDTO $dto) {
		$entity = new $this->model;
		$this->mapper->entity($dto, $entity);
		$this->dao->persist($entity);
		$dto->setId($entity->getId());
	}

	function read($id) {
		$entity = $this->dao->findById($id);
		$dto = $this->mapper->dto($entity);
		return $dto;
	}

	function update(AbstractDTO $dto) {
		$entity = $this->dao->findById($dto->getId());
		$this->mapper->entity($dto, $entity);
		$this->dao->flush($entity);
	}

	function delete(AbstractDTO &$dto) {
		$entity = $this->dao->findById($dto->getId());
		$this->dao->remove($entity);
		$class = get_class($dto);
		$dto = new $class;
	}

	function listAll() {
		$entities = $this->dao->listAll();
		$dtos = $this->mapper->dtos($entities);
		return $dtos;
	}

}