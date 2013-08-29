<?php

namespace Model;

/**
 * @Entity
 * @Table (name="owner")
 */
class Owner extends AbstractModel
{

	/**
	 * @Id
	 * @Column (name="id")
	 * @Type int4
	 * @NotNull
	 * @Default (value="nextval('owner_id_seq'::regclass)")
	 */
	private $id;

	/**
	 * @Column (name="email")
	 * @Type varchar
	 * @NotNull
	 * @Size (max="20")
	 */
	private $email;

	/**
	 * @Column (name="password")
	 * @Type varchar
	 * @NotNull
	 * @Size (max="34")
	 */
	private $password;

//	function __construct($email, $password)
//	{
//		$this->email = $email;
//		$this->password = $password;
//	}

	function setId($id)
	{
		$this->id = $id;
	}

	function getId()
	{
		return $this->id;
	}

	function setEmail($email)
	{
		$this->email = $email;
	}

	function getEmail()
	{
		return $this->email;
	}

	function setPassword($password)
	{
		$this->password = $password;
	}

	function getPassword()
	{
		return $this->password;
	}

}