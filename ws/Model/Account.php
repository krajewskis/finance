<?php

namespace Model;

/**
 * @Entity
 * @Table (name="account")
 */
class Account extends AbstractModel {

	/**
	 * @Id
	 * @Column (name="id")
	 * @Type int4
	 * @NotNull
	 * @Default (value="nextval('account_id_seq'::regclass)")
	 */
	private $id;

	/**
	 * @Column (name="owner_id")
	 * @Type int4
	 * @NotNull
	 */
	private $ownerId;

	/**
	 * @Column (name="id_parent")
	 * @Type int4
	 */
	private $idParent;

	/**
	 * @Column (name="name")
	 * @Type varchar
	 * @NotNull
	 * @Size (max="20")
	 */
	private $name;

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