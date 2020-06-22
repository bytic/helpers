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
            $assetEntry = Assets::entry();
            if (assets_manager()->hasEntrypoint('tinymce')) {
                $assetEntry->addFromWebpack('tinymce');
                return;
            }
            $base = $this->getBase();
            if (\Nip\Utility\Url::isValid($base)) {
                Assets::entry()->scripts()->add($base . '/jquery.tinymce.min.js');
                Assets::entry()->scripts()->add($base . '/tinymce.min.js');
                Assets::entry()->scripts()->add($base . '/init.js');
                return;
            }
            Assets::entry()->scripts()->add($base . '/jquery.tinymce.min');
            Assets::entry()->scripts()->add($base . '/tinymce.min');
            Assets::entry()->scripts()->add($base . '/init');
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
    }
}
