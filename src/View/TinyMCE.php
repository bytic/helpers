<?php

namespace Nip\Helpers\View;

use ByTIC\Assets\Assets;

/**
 * Class TinyMCE
 * @package Nip\Helpers\View
 */
class TinyMCE extends AbstractHelper
{
    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var string
     */
    protected $base = 'tinymce';

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled = true)
    {
        $this->enabled = $enabled;
    }

    public function init()
    {
        if ($this->enabled) {
            Assets::entry()->scripts()->add($this->getBase() . '/jquery.tinymce.min');
            Assets::entry()->scripts()->add($this->getBase() . '/tinymce.min');
            Assets::entry()->scripts()->add($this->getBase() . '/init');
        }
    }

    /**
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param $base
     */
    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }
}
