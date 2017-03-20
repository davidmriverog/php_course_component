<?php

use Styde\AccessHandler;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{
    public function test_grant_access()
    {
        $this->assertTrue(
            AccessHandler::check('ADMIN')
        );
    }
}