<?php

declare(strict_types=1);

namespace Nip\Helpers\Tests;

/**
 * Class TimeTest
 * @package Nip\Helpers\Tests
 */
class StringTest extends AbstractTest
{
    /**
     * @param $input
     * @param $output
     * @dataProvider data_cronoTimeInSeconds
     */
    public function test_cronoTimeInSeconds($input, $output)
    {
        $helper = new \Nip_Helper_Strings();

        self::assertEquals($output, $helper->cronoTimeInSeconds($input));
    }

    public function data_cronoTimeInSeconds(): array
    {
        return [
            ['0:50', 50],
            ['0:50', 50],
            ['1:50', 110],
            ['1:1:50', 3710],
        ];
    }
}