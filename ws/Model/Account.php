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