<?php

namespace DTO;

class OwnerDTO extends AbstractDTO {

	public $id;
	public $email;
	public $password;

	function setId($id) {
		$this->id = $id;
	}

	function getId() {
		return $this->id;
	}

	function setEmail($email) {
		$this->email = $email;
	}

	function getEmail() {
		return $this->email;
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function getPassword() {
		return $this->password;
	}

}