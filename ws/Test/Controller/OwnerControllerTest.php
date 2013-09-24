<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 18:24
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Controller;

use DTO\OwnerDTO;
use Framework\DB;
use Framework\CURL;
use PHPUnit_Framework_TestCase;

class OwnerControllerTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var DB;
	 */
	private $db;
	/**
	 * @var CURL
	 */
	private $curl;

	const ID = 1;
	const EMAIL = 'EMAIL';
	const EMAIL_ANOTHER = 'EMAIL_ANOTHER';
	const PASSWORD = 'PASSWORD';
	const PASSWORD_ANOTHER = 'PASSWORD_ANOTHER';

	const URL = 'http://localhost/finance/ws/?/owner';

	public function setUp()
	{
		$this->db = DB::getInstance();
		$this->curl = new CURL(self::URL);
		$this->db->query('
			DELETE FROM owner;
			ALTER SEQUENCE owner_id_seq RESTART 1;
		');
	}

	public function testCRUD()
	{
		$dto = new OwnerDTO();
		$dto->setEmail(self::EMAIL);
		$dto->setPassword(self::PASSWORD);

		$json = json_encode($dto);

		$this->curl->doPost($json);

		$data = $this->curl->getResultData();

		$this->assertEquals(self::ID, $data->id);
		$this->assertEquals(self::EMAIL, $data->email);
		$this->assertNull($data->password);


		$this->curl->doGetId(self::ID);

		$data = $this->curl->getResultData();

		$this->assertEquals(self::ID, $data->id);
		$this->assertEquals(self::EMAIL, $data->email);
		$this->assertNull($data->password);


		$dto->setId(self::ID);
		$dto->setEmail(self::EMAIL_ANOTHER);

		$json = json_encode($dto);

		$this->curl->doPut(self::ID, $json);

		$data = $this->curl->getResultData();
		$this->assertEquals(self::ID, $data->id);
		$this->assertEquals(self::EMAIL_ANOTHER, $data->email);
		$this->assertNull($data->password);


		$this->curl->doDelete(self::ID);

		$this->curl->doGetId(self::ID);

		$data = $this->curl->getResultData();

		$this->assertNull($data->id);
		$this->assertNull($data->email);
		$this->assertNull($data->password);
	}

	public function tearDown()
	{
		$this->db->query('
			DELETE FROM owner;
			ALTER SEQUENCE owner_id_seq RESTART 1;
		');
	}
}