<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 17:38
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Service;

use DTO\OwnerDTO;
use Framework\DB;
use PHPUnit_Framework_TestCase;
use Service\OwnerService;

class OwnerServiceTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var DB;
	 */
	private $db;
	/**
	 * @var OwnerService;
	 */
	private $service;

	const ID = 1;
	const EMAIL = 'EMAIL';
	const EMAIL_ANOTHER = 'EMAIL_ANOTHER';
	const PASSWORD = 'PASSWORD';
	const PASSWORD_ANOTHER = 'PASSWORD_ANOTHER';

	public function setUp()
	{
		$this->db = DB::getInstance();
		$this->service = new OwnerService();
	}

	public function testCRUD()
	{
		$dto = new OwnerDTO();
		$dto->setEmail(self::EMAIL);
		$dto->setPassword(self::PASSWORD);
		$this->service->create($dto);

		$this->assertEquals(self::ID, $dto->getId());
		$this->assertEquals(self::EMAIL, $dto->getEmail());

		$dto = $this->service->read(self::ID);
		$this->assertEquals(self::ID, $dto->getId());
		$this->assertEquals(self::EMAIL, $dto->getEmail());

		$dto->setEmail(self::EMAIL_ANOTHER);
		$this->service->update($dto);

		$dto = $this->service->read(self::ID);
		$this->assertEquals(self::ID, $dto->getId());
		$this->assertEquals(self::EMAIL_ANOTHER, $dto->getEmail());

		$this->service->delete(self::ID);
		$dto = $this->service->read(self::ID);
		$this->assertEquals(null, $dto->getId());
		$this->assertEquals(null, $dto->getEmail());
		$this->assertEquals(null, $dto->getPassword());
	}

	public function testEmailAndPasswordsChanging()
	{
		$dto = new OwnerDTO();
		$dto->setEmail(self::EMAIL);
		$dto->setPassword(self::PASSWORD);
		$this->service->create($dto);

		$status = $this->service->auth(self::EMAIL,self::PASSWORD);
		$this->assertEquals(true, $status);

		$this->service->changePassword(self::ID,self::PASSWORD_ANOTHER);

		$status = $this->service->auth(self::EMAIL,self::PASSWORD_ANOTHER);
		$this->assertEquals(true, $status);

		$status = $this->service->auth(self::EMAIL,self::PASSWORD);
		$this->assertEquals(false, $status);
	}

	public function tearDown()
	{
		$this->db->query('
			DELETE FROM owner;
			ALTER SEQUENCE owner_id_seq RESTART 1;
		');
	}
}