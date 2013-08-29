<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 15:25
 * To change this template use File | Settings | File Templates.
 */

namespace Test\DAO;

use DAO\OwnerDAO;
use Framework\DB;
use Framework\EntityManager;
use Model\Owner;
use PHPUnit_Framework_TestCase;

class OwnerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DB;
	 */
	private $db;
	/**
	 * @var OwnerDAO;
	 */
	private $dao;

	const ID = 1;
	const EMAIL = 'EMAIL';
	const PASSWORD = 'PASSWORD';
	const PASSWORD_ANOTHER = 'PASSWORD_ANOTHER';

	function setUp()
	{
		$this->db = DB::getInstance();
		$this->dao = new OwnerDAO();
	}

	function testCRUD()
	{
		$entity = new Owner();
		$entity->setEmail(self::EMAIL);
		$entity->setPassword(self::PASSWORD);

		$this->dao->persist($entity);
		$this->assertEquals(self::ID, $entity->getId());
		$this->assertEquals(self::EMAIL, $entity->getEmail());
		$this->assertEquals(self::PASSWORD, $entity->getPassword());

		$entity = $this->dao->findById(self::ID);
		$this->assertEquals(self::ID, $entity->getId());
		$this->assertEquals(self::EMAIL, $entity->getEmail());
		$this->assertEquals(self::PASSWORD, $entity->getPassword());

		$entity->setPassword(self::PASSWORD_ANOTHER);
		$this->dao->persist($entity);

		$entity = $this->dao->findById(self::ID);
		$this->assertEquals(self::ID, $entity->getId());
		$this->assertEquals(self::EMAIL, $entity->getEmail());
		$this->assertEquals(self::PASSWORD_ANOTHER, $entity->getPassword());

		$this->dao->remove($entity);
		$this->assertEquals(null, $entity->getId());
		$this->assertEquals(null, $entity->getEmail());
		$this->assertEquals(null, $entity->getPassword());
	}

	function tearDown()
	{
		$this->db->query('
			DELETE FROM owner;
			ALTER SEQUENCE owner_id_seq RESTART 1;
		');
	}

}