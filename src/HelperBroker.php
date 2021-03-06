<?php

namespace Nip;

use Nip\Helpers\AbstractHelper;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class HelperBroker
 * @package Nip
 */
class HelperBroker
{
    use SingletonTrait;

    /**
     * @var AbstractHelper[]
     */
    protected $helpers = [];

    /**
     * @param $name
     * @return AbstractHelper
     */
    public static function get($name): AbstractHelper
    {
        $broker = self::instance();

        return $broker->getByName($name);
    }

    /**
     * @param $name
     * @return boolean
     */
    public static function has($name): bool
    {
        $broker = self::instance();

        return $broker->hasHelper($name);
    }

    /**
     * @param $name
     * @return AbstractHelper
     */
    public function getByName($name)
    {
        $name = self::getNameKey($name);
        if (!$this->hasHelper($name)) {
            $this->initHelper($name);
        }

        return $this->helpers[$name];
    }

    /**
     * @param $name
     * @return string
     */
    public static function getNameKey($name)
    {
        return strtolower($name);
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasHelper($name)
    {
        $name = self::getNameKey($name);

        return isset($this->helpers[$name]);
    }

    /**
     * @param $name
     */
    public function initHelper($name)
    {
        $this->helpers[$name] = $this->generateHelper($name);
    }

    /**
     * @param $name
     * @return AbstractHelper
     */
    public function generateHelper($name)
    {
        $class = $this->getHelperClass($name);
        $helper = new $class;

        return $helper;
    }

    /**
     * @param $name
     * @return string
     */
    public function getHelperClass($name)
    {
        return 'Nip_Helper_' . ucfirst($name);
    }
}
