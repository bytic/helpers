<?php

namespace Nip\Helpers\Tests\View;

use Nip\Helpers\View\Messages;

/**
 * Class MessagesTest
 * @package Nip\Tests\Helpers\View
 */
class MessagesTest extends \Nip\Helpers\Tests\AbstractTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Messages
     */
    protected $_object;

    public function testWarning()
    {
        static::assertEquals(Messages::warning('messages'), '<div class="alert alert-warning">messages</div>');
        static::assertEquals($this->_object->warning('messages'), '<div class="alert alert-warning">messages</div>');
    }

    public function testInfo()
    {
        static::assertEquals(Messages::info('messages'), '<div class="alert alert-info">messages</div>');
        static::assertEquals($this->_object->info('messages'), '<div class="alert alert-info">messages</div>');
    }

    // tests

    protected function setUp()
    {
        $this->_object = new Messages();
    }
}
