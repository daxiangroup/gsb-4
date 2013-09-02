<?php

use \GSB\Group\GroupService;

class GroupServiceTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testGroupServiceType()
	{
		$this->assertInstanceOf('GSB\Group\GroupService', new GSB\Group\GroupService);
	}

	/**
	 * Testin
	 */
	public function testStringParameter()
	{
		$this->setExpectedException('InvalidArgumentException');
		GroupService::getGroups('string');
	}

}