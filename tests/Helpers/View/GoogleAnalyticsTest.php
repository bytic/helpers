<?php

namespace Nip\Helpers\Tests\Helpers\View;

use Mockery as m;
use Nip\FlashData\FlashData;
use Nip\Helpers\View\GoogleAnalytics;

/**
 * Class GoogleAnalyticsTest
 * @package Nip\Helpers\Tests\Helpers\View
 */
class GoogleAnalyticsTest extends \Nip\Helpers\Tests\AbstractTest
{

    public function testAddOperation()
    {
        $data = [
            'id' => 1,
            'amount' => 100,
        ];
        $this->_object->addTransaction($data);

        $response = [
            1 => $data,
        ];

        static::assertEquals($this->_object->getTransactions(), $response);
    }

    protected function setUp()
    {
        parent::setUp();

        $flashMock = m::mock(FlashData::class)->makePartial();

        $this->_object = new GoogleAnalytics();
        $this->_object->setFlashMemory($flashMock);
    }
}
