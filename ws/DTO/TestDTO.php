<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 29.8.13
 * Time: 10:50
 * To change this template use File | Settings | File Templates.
 */

namespace DTO;


class TestDTO extends AbstractDTO {

	public $test;

	/**
	 * @param mixed $test
	 */
	public function setTest($test)
	{
		$this->test = $test;
	}

	/**
	 * @return mixed
	 */
	public function getTest()
	{
		return $this->test;
	}

}