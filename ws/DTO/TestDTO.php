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

	public $id;
	public $test;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setTest($test)
	{
		$this->test = $test;
	}

	public function getTest()
	{
		return $this->test;
	}


}