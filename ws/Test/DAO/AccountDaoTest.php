<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 16:30
 * To change this template use File | Settings | File Templates.
 */

namespace Test\DAO;


use DAO\AccountDAO;
use Framework\DB;
use Model\Account;
use \PHPUnit_Framework_TestCase;

class AccountTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DB;
	 */
	private $db;
	/**
	 * @var AccountDAO;
	 */
	private $dao;

	const ID = 1;
	const NAME = 'ACCOUNT';
	const NAME_ANOTHER = 'ACCOUNT_ANOTHER';

	public function setUp()
	{
		$this->db = DB::getInstance();
		$this->dao = new AccountDAO();
		$this->db->query("INSERT INTO owner VALUES (1, 'temp','temp');");
	}

	public function testCRUD()
	{
		$entity = new Account();
		$entity->setName(self::NAME);
		$entity->setOwnerId(1);
		$this->dao->persist($entity);

		$this->assertEquals(self::ID, $entity->getId());
		$this->assertEquals(self::NAME, $entity->getName());

		$entity = $this->dao->findById(self::ID);

		$this->assertEquals(self::ID, $entity->getId());
		$this->assertEquals(self::NAME, $entity->getName());

		$entity->setName(self::NAME_ANOTHER);

		$entity = $this->dao->flush($entity);

		$entity = $this->dao->findById(self::ID);

		$this->assertEquals(self::ID, $entity->getId());
		$this->assertEquals(self::NAME_ANOTHER, $entity->getName());

		$this->dao->remove($entity);
		$this->assertEquals(null, $entity->getId());
		$this->assertEquals(null, $entity->getName());

	}

	public function tearDown()
	{
		$this->db->query('
			DELETE FROM account;
			ALTER SEQUENCE account_id_seq RESTART 1;
			DELETE FROM owner;
			ALTER SEQUENCE owner_id_seq RESTART 1;
		');
	}
}