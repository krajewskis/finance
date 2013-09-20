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

//	public function __construct($email, $password)
//	{
//		$this->email = $email;
//		$this->password = $password;
//	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

}