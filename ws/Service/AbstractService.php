<?php

namespace Service;

use DAO\AbstractDAO;
use DTO\AbstractDTO;
use Mapper\AbstractMapper;

abstract class AbstractService
{

	protected $model;
	protected $dto;
	protected $dao;
	protected $mapper;

	public function __construct($model, $dto, AbstractDAO $dao, AbstractMapper $mapper)
	{
		$this->model = $model;
		$this->dto = $dto;
		$this->dao = $dao;
		$this->mapper = $mapper;
	}

	public function create(AbstractDTO $dto)
	{
		$entity = new $this->model;
		$this->mapper->entity($dto, $entity);
		$this->dao->persist($entity);
		$dto->setId($entity->getId());
	}

	public function read($id)
	{
		$entity = $this->dao->findById($id);
		if (is_null($entity)) {
			$dto = new $this->dto;
		} else {
			$dto = $this->mapper->dto($entity);
		}
		return $dto;
	}

	public function update(AbstractDTO $dto)
	{
		$entity = $this->dao->findById($dto->getId());
		$this->mapper->entity($dto, $entity);
		$this->dao->flush($entity);
	}

	public function delete($id)
	{
		$entity = $this->dao->findById($id);
		$this->dao->remove($entity);
	}

	public function listAll()
	{
		$entities = $this->dao->listAll();
		$dtos = $this->mapper->dtos($entities);
		return $dtos;
	}

}