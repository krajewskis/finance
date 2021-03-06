<?php

namespace Mapper;

abstract class AbstractMapper {

	public function dtos(array $entities) {
		$dtos = array();
		foreach($entities as $entity) {
			$dtos[] = $this->dto($entity);
		}
		return $dtos;
	}
}