<?php

namespace DTO;

class AccountDTO extends AbstractDTO {

	public $id;
	public $ownerId;
	public $idParent;
	public $name;

	function setId($id) {
		$this->id = $id;
	}

	function getId() {
		return $this->id;
	}

	function setOwnerId($ownerId) {
		$this->ownerId = $ownerId;
	}

	function getOwnerId() {
		return $this->ownerId;
	}

	function setIdParent($idParent) {
		$this->idParent = $idParent;
	}

	function getIdParent() {
		return $this->idParent;
	}

	function setName($name) {
		$this->name = $name;
	}

	function getName() {
		return $this->name;
	}

}