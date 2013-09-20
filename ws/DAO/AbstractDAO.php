<?php

namespace DAO;

use Framework\EntityManager;
use Model\AbstractModel;

abstract class AbstractDAO
{

	protected $em;

	public function __construct($model)
	{
		$this->em = new EntityManager($model);
	}

	public function persist(AbstractModel $entity)
	{
		$this->em->persist($entity);
	}

	public function flush(AbstractModel $entity)
	{
		$this->em->flush($entity);
	}

	public function findById($id)
	{
		return $this->em->findById($id);
	}

	public function listAll()
	{
		return $this->em->findBy(array());
	}

	public function remove(AbstractModel &$entity)
	{
		$this->em->remove($entity->getId());
		$class = get_class($entity);
		$entity = new $class;
	}
}