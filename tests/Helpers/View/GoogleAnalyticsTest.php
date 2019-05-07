<?php

namespace Nip\Helpers\Tests\Helpers\View;

use Mockery as m;
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
            'orderId' => 1,
            'amount'  => 100,
        ];
        $this->_object->addTransaction($data);

        $response = [
            1 => (object) $data,
        ];

        static::assertEquals($this->_object->getTransactions(), $response);
    }

    protected function setUp()
    {
        $flashMock = m::mock('Nip_Flash')->shouldDeferMissing();

        $this->_object = new GoogleAnalytics();
        $this->_object->setFlashMemory($flashMock);
        $this->_object->setUA($this->_ua);
        $this->_object->setDomain($this->_domain);
    }
}
