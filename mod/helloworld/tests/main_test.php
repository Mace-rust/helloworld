<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class my_plugin_test extends TestCase
{

    public function test_hello_world()
    {
        $this->assertEquals('Hello world', 'Hello world');
    }
}
