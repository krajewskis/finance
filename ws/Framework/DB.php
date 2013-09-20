<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 15:45
 * To change this template use File | Settings | File Templates.
 */

namespace Framework;


class DB
{
	const SERVER = 'localhost';
	const USER = 'postgres';
	const PASSWORD = '123qwe!@#';
	const DB = 'finance4';

	static $instance;

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct()
	{
		pg_connect('host=' . self::SERVER . ' port=5432 dbname=' . self::DB . ' user=' . self::USER . ' password=' . self::PASSWORD);
	}

	public function query($sql)
	{
		return pg_query($sql);
	}
}