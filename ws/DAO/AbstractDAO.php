<?php

namespace DAO;

use Framework\EntityManager;
use Model\AbstractModel;

abstract class AbstractDAO
{

	protected $em;

	function __construct($model)
	{
		$this->em = new EntityManager($model);
	}

	function persist(AbstractModel $entity)
	{
		$this->em->persist($entity);
	}

	function flush(AbstractModel $entity)
	{
		$this->em->flush($entity);
	}

	function findById($id)
	{
		return $this->em->findById($id);
	}

	function listAll()
	{
		return $this->em->findBy(array());
	}

	function remove(AbstractModel &$entity)
	{
		$this->em->remove($entity->getId());
		$class = get_class($entity);
		$entity = new $class;
	}
}