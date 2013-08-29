<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 18:24
 * To change this template use File | Settings | File Templates.
 */

namespace Test\Controller;

use Framework\DB;
use PHPUnit_Framework_TestCase;

class OwnerControllerTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var DB;
	 */
	private $db;

	const ID = 1;
	const EMAIL = 'EMAIL';
	const PASSWORD = 'PASSWORD';
	const PASSWORD_ANOTHER = 'PASSWORD_ANOTHER';

	const URL = 'http://localhost/finance/ws/?/owner/';

	function setUp()
	{
		$this->db = DB::getInstance();
	}

	function testOwner()
	{
		$ch = curl_init(self::URL);
		$data = json_encode(array('email'=>self::EMAIL,'password'=>self::PASSWORD));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		print_r($result);
	}

	function tearDown()
	{
		$this->db->query('
			DELETE FROM owner;
			ALTER SEQUENCE owner_id_seq RESTART 1;
		');
	}
}