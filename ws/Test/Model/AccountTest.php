<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 16:30
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Model;


use DAO\AccountDAO;
use Framework\DB;
use Framework\EntityManager;
use Model\Account;
use \PHPUnit_Framework_TestCase;

class AccountTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DB;
	 */
	private $db;
	/**
	 * @var EntityManager;
	 */
	private $em;
	/**
	 * @var AccountDAO;
	 */
	private $dao;

	const ID = 1;
	const NAME = 'ACCOUNT';

	function setUp()
	{
		$this->db = DB::getInstance();
		$this->em = new EntityManager('Model\Account');
		$this->dao = new AccountDAO();
		$this->db->query("INSERT INTO owner VALUES (1, 'temp','temp');");
	}

	function testCRUD()
	{
		$entity = new Account();
		$entity->setName(self::NAME);
		$entity->setOwnerId(1);
		$this->dao->persist($entity);
	}

	function tearDown()
	{
		$this->db->query('
			DELETE FROM account;
			ALTER SEQUENCE account_id_seq RESTART 1;
			DELETE FROM owner;
			ALTER SEQUENCE owner_id_seq RESTART 1;
		');
	}
}