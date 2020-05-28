<?php

use Nip\Helpers\AbstractHelper;
use Nip\Utility\Str;
use Nip\Utility\Url;

/**
 * Class Nip_Helper_Url
 */
class Nip_Helper_Url extends AbstractHelper
{
    use \Nip\Router\RouterAwareTrait;
    use \Nip\Utility\Traits\SingletonTrait;

    protected $pieces = [];

    /**
     * @param $name
     * @param $arguments
     * @return $this|mixed
     */
    public function __call($name, $arguments)
    {
        if ($name == ucfirst($name)) {
            $this->pieces[] = inflector()->underscore($name);
            return $this;
        } else {
            $this->pieces[] = $name;
        }

        $name = $this->pieces ? implode(".", $this->pieces) : '';
        $this->pieces = [];
        return $this->assemble($name, isset($arguments[0]) ? $arguments[0] : []);
    }

    /**
     * @param $name
     * @param bool $params
     * @return string|null
     */
    public function assemble($name, $params = [])
    {
        return $this->getRouter()->assembleFull($name, $params);
    }

    /**
     * @param $name
     * @param bool $params
     * @return string|null
     */
    public function get($name, $params = [])
    {
        return $this->assemble($name, $params);
    }

    /**
     * @param $name
     * @param bool $params
     * @return string|null
     */
    public function image($path = null)
    {
        return asset('/images/'.$path);
    }

    /**
     * @param $name
     * @param bool $params
     * @return string|null
     */
    public function route($name, $params = false)
    {
        return $this->getRouter()->assemble($name, $params);
    }

    /**
     * @param array $params
     * @return string
     */
    public function base($params = [])
    {
        $base = request()->root();

        return $base . ($params ? "?" . http_build_query($params) : '');
    }

    /**
     * @param array $params
     * @return string
     * @deprecated
     */
    public function build($params)
    {
        return Url::build($params);
    }

    /**
     * @param string $input
     * @return string
     * @deprecated use Nip\Utility\Str::slug
     */
    public function encode($input)
    {
        return Str::slug($input);
    }
}
