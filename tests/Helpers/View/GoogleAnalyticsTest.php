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
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var GoogleAnalytics
     */
    protected $_object;

    protected $trackingId = '';
    protected $trackingDomain = 'galantom.loc';

    public function testAddOperation()
    {
        $data = [
            'id' => 1,
            'amount' => 100,
        ];
        $this->_object->addTransaction($data);

        $response = [
            1 => (object) $data
        ];

        static::assertEquals($this->_object->getTransactions(), $response);
    }

    protected function setUp()
    {
        parent::setUp();

        $flashMock = m::mock(FlashData::class)->shouldDeferMissing();

        $this->_object = new GoogleAnalytics();
        /** @noinspection PhpParamsInspection */
        $this->_object->setFlashMemory($flashMock);
        $this->_object->setTrackingId($this->trackingId);
        $this->_object->setDomain($this->trackingDomain);
    }
}
