<?php

namespace Nip\Helpers\Traits;

use Nip\HelperBroker;

/**
 * Trait HasHelpersTrait
 * @package Nip\Helpers\Traits
 */
trait HasHelpersTrait
{
    /**
     * @param $name
     * @return bool
     */
    public function isHelperCall($name)
    {
        return HelperBroker::has($name);
    }

    /**
     * @param string $name
     * @return \Nip\Helpers\AbstractHelper
     */
    public function getHelper($name)
    {
        return HelperBroker::get($name);
    }
}
