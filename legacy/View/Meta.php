<?php

namespace Nip\Helpers\View;

use ByTIC\SeoMeta\Utility\SeoMeta;
use Nip\Config\Config;
use stdClass;

/**
 * Nip Framework
 *
 * @category   Nip
 * @copyright  2009 Nip Framework
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @version    SVN: $Id: Meta.php 60 2009-04-28 14:50:04Z victor.stanciu $
 */
class Meta extends AbstractHelper
{
    /**
     * @param Config $config
     */
    public function populateFromConfig($config)
    {
        $this->setTitleBase($config->get('title'));
        SeoMeta::authors($config->get('authors'));
        $this->setDescription($config->get('description'));
        $this->addKeywords(explode(",", $config->get('keywords')));
    }

    /**
     * @param $base
     * @return $this
     * @deprecated use SeoMeta::setTitleBase($base);
     */
    public function setTitleBase($base)
    {
        SeoMeta::setTitleBase($base);

        return $this;
    }

    /**
     * @param $keywords
     * @return $this
     * @deprecated use SeoMeta::addKeywords($keywords)
     */
    public function addKeywords($keywords)
    {
        SeoMeta::addKeywords($keywords);

        return $this;
    }

    /**
     * @param $title
     * @return $this
     * @deprecated use SeoMeta::appendTitle($title)
     */
    public function appendTitle($title)
    {
        SeoMeta::appendTitle($title);

        return $this;
    }

    /**
     * @param $title
     * @return $this
     * @deprecated use SeoMeta::prependTitle($title)
     */
    public function prependTitle($title)
    {
        SeoMeta::appendTitle($title);

        return $this;
    }

    /**
     * @return mixed
     * @deprecated use SeoMeta::getFirstTitle()
     */
    public function getFirstTitle()
    {
        return SeoMeta::getFirstTitle();
    }

    /**
     * @param $description
     */
    public function addDescription($description)
    {
        return $this->setDescription($description);
    }

    /**
     * @param $description
     * @return $this
     * @deprecated use SeoMeta::getFirstTitle($description)
     */
    public function setDescription($description)
    {
        SeoMeta::description($description);

        return $this;
    }


    /**
     * @return string
     * @deprecated use SeoMeta::render()
     */
    public function __toString()
    {
        return SeoMeta::render();
    }
}
