<?php

namespace Framework;

use \ReflectionClass;
use \stdClass;

class EntityManager
{
	private $db;
	private $class;
	private $table;
	private $id;
	private $fields;

	public function __construct($class)
	{
		$this->db = DB::getInstance();

		$this->class = $class;

		$reflectionClass = new ReflectionClass($class);
		$docComment = $reflectionClass->getDocComment();
		$docComment = str_replace(' ', '', $docComment);

		if (preg_match('/@Entity/', $docComment)) {
			preg_match('/@Table\(name="([a-z]+)"\)/', $docComment, $matches);
			$this->table = $matches[1];

			foreach ($reflectionClass->getProperties() as $reflectionProperty) {
				$field = new stdClass();
				$field->name = $reflectionProperty->getName();
				$docComment = $reflectionProperty->getDocComment();
				$docComment = str_replace(' ', '', $docComment);

				if (!preg_match('/@Transient/', $docComment)) {
					if (preg_match('/@Id/', $docComment)) {
						$this->id = $field->name;
					}
					preg_match('/@Column\(name="([a-z_]+)"\)/', $docComment, $matches);
					$field->column = $matches[1];

					if (preg_match('/@NotNull/', $docComment)) {
						$field->notnull = true;
					}

					preg_match('/@Type([a-z]+)/', $docComment, $matches);
					$field->type = $matches[1];

					if (preg_match('/@Size\(max=\"([a-z]+)\"\)/', $docComment, $matches)) {
						$field->size = $matches[1];
					}

					// 					if(preg_match('/@Default(value=\"([a-z]+)\"\)/',$docComment,$matches))
					// 					{
					// 						$field->default = $matches[1];
					// 					}

					$this->fields[$field->name] = $field;
				}
			}
		}
	}

	public function persist($entity)
	{
		$insert = array();
		$update = array();

		foreach ($this->fields as $name => $field) {
			if ($this->id != $field->name) {
				$value = $entity->{'get' . ucfirst($field->name)}();
				if (is_null($value) && isset($field->default)) {
					$value = $field->default;
				}

				if (!is_null($value)) {

					switch ($field->type) {
						case 'int':
							break;

						case 'bool':
							$value = $value ? 'true' : 'false';
							break;

						case 'date':
						case 'timestamp':
							$value = "'$value'";
							break;

						case 'varchar':
						case 'text':
							$value = "'" . pg_escape_string($value) . "'";
							break;
					}
				} else {
					$value = 'NULL';
				}

				$insert[$field->column] = $value;
				$update[] = $field->column . ' = ' . $value;
			}
		}

		if (!$entity->getId()) {

			$columns = implode(',', array_keys($insert));
			$values = implode(',', $insert);
			$sql = "INSERT INTO $this->table ($columns) VALUES ($values) RETURNING $this->id;";
		} else {
			$update_string = implode(', ', $update);
			$sql = "UPDATE $this->table SET $update_string WHERE $this->id = {$entity->getId()};";

		}

		$result = $this->db->query($sql);
		if (!$entity->getId()) {
			$fetched_data = pg_fetch_array($result);
			$entity->setId((int)$fetched_data[$this->id]);
			if ($entity->getId() == 0) {
				throw new Exception(pg_last_error());
			}
		}
	}

	public function flush($entity)
	{
		$this->persist($entity);
	}

	public function remove($id)
	{
		$sql = "DELETE FROM $this->table WHERE $this->id = $id";
		$this->db->query($sql);
	}

	public function findById($id)
	{
		$id = (int)$id;
		$select = $this->prepare_select();
		$sql = "SELECT $select FROM $this->table WHERE $this->id = $id";
		$result = $this->db->query($sql);
		$entities = $this->fill($result);
		return count($entities) ? $entities[0] : null;
	}

	public function findBy(array $array)
	{
		$select = $this->prepare_select();
		$where = array();
		foreach ($array as $key => $val) {
			$where[] = "$key = '$val'";
		}
		$where = implode(' AND ', $where);
		$sql = "SELECT $select FROM $this->table " . ($where ? "WHERE $where" : null);
		$result = $this->db->query($sql);
		$entities = $this->fill($result);
		return $entities;
	}

	public function findByOne(array $array)
	{
		$entities = $this->findBy($array);
		return count($entities) ? $entities[0] : null;
	}

	private function prepare_select()
	{
		$select = array();

		foreach ($this->fields as $name => $field) {
			$column = $field->column;
			switch ($field->type) {
				case 'bool';
					$column = "$column::int AS $column";
					break;
			}
			$select[] = $column;
		}
		$select = implode(', ', $select);
		return $select;
	}

	private function fill($result)
	{
		$entities = array();
		while ($fetched_data = pg_fetch_object($result)) {
			$entity = new $this->class;
			foreach ($this->fields as $name => $field) {
				$entity->{'set' . ucfirst($field->name)}($fetched_data->{$field->column});
			}
			$entities[] = $entity;
		}
		return $entities;
	}

	public function getClass()
	{
		return $this->class;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTable()
	{
		return $this->table;
	}
}