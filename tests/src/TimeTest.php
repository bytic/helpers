<?php

namespace Nip\Helpers\Tests;

/**
 * Class TimeTest
 * @package Nip\Helpers\Tests
 */
class TimeTest extends AbstractTest
{
    /**
     * @param $seconds
     * @param $output
     * @dataProvider data_secondsInStringTime
     */
    public function test_secondsInStringTime($seconds, $output)
    {
        $helper = new \Nip_Helper_Time();

        self::assertSame($output, $helper->secondsInStringTime($seconds));
    }

    public function data_secondsInStringTime(): array
    {
        return [
            [50, '50s'],
            [500, '08m 20s'],
            [5000, '01h 23m 20s'],
            [50000, '13h 53m 20s'],
        ];
    }
}