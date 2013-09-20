<?php

namespace DTO;

class AccountDTO extends AbstractDTO {

	public $id;
	public $ownerId;
	public $idParent;
	public $name;

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setOwnerId($ownerId) {
		$this->ownerId = $ownerId;
	}

	public function getOwnerId() {
		return $this->ownerId;
	}

	public function setIdParent($idParent) {
		$this->idParent = $idParent;
	}

	public function getIdParent() {
		return $this->idParent;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

}