<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 16:30
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Model;

use DTO\AccountDTO;
use Framework\DB;
use Service\AccountService;
use \PHPUnit_Framework_TestCase;

class AccountTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DB;
	 */
	private $db;
	/**
	 * @var AccountService;
	 */
	private $service;

	const ID = 1;
	const NAME = 'ACCOUNT';
	const NAME_ANOTHER = 'ACCOUNT_ANOTHER';

	public function setUp()
	{
		$this->db = DB::getInstance();
		$this->service = new AccountService();
		$this->db->query("INSERT INTO owner VALUES (1, 'temp','temp');");
	}

	public function testCRUD()
	{
		$dto = new AccountDTO();
		$dto->setName(self::NAME);
		$dto->setOwnerId(1);
		$this->service->create($dto);

		$this->assertEquals(self::ID, $dto->getId());
		$this->assertEquals(self::NAME, $dto->getName());

		$dto = $this->service->read(self::ID);

		$this->assertEquals(self::ID, $dto->getId());
		$this->assertEquals(self::NAME, $dto->getName());

		$dto->setName(self::NAME_ANOTHER);

		$dto = $this->service->update($dto);

		$dto = $this->service->read(self::ID);

		$this->assertEquals(self::ID, $dto->getId());
		$this->assertEquals(self::NAME_ANOTHER, $dto->getName());

		$this->service->delete(self::ID);
		$dto = $this->service->read(self::ID);
		$this->assertEquals(null, $dto->getId());
		$this->assertEquals(null, $dto->getName());
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