<?php

namespace Nip\Helpers\Tests;

/**
 * Class PasswordsTest
 * @package Nip\Helpers\Tests
 */
class PasswordsTest extends AbstractTest
{
    public function test_generate()
    {
        $helper = new \Nip_Helper_Passwords();

        $pass1 = $helper->generate(10);
        $pass2 = $helper->generate(10);

        self::assertSame(10, strlen($pass1));
        self::assertSame(10, strlen($pass2));
        self::assertNotSame($pass1, $pass2);
    }
}