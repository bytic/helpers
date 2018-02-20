<?php

namespace Nip\Helpers\View;

class Messages extends AbstractHelper
{
    public static $_cssClass = [
        'warning' => 'alert alert-warning',
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'info'    => 'alert alert-info',
    ];

    public static function warning($items = [], $wrap = true)
    {
        return self::render($items, 'warning', $wrap);
    }

    public static function info($items = [], $wrap = true)
    {
        return self::render($items, 'info', $wrap);
    }

    public static function success($items = [], $wrap = true)
    {
        return self::render($items, 'success', $wrap);
    }

    public static function error($items = [], $wrap = true)
    {
        return self::render($items, 'error', $wrap);
    }

    public static function render($items = [], $type = false, $wrap = true)
    {
        $return = '';

        $items = (array) $items;

        if (count($items)) {
            if ($wrap) {
                $return .= '<div class="'.($type ? self::$_cssClass[$type] : '').'">';
                if (count($items) > 1) {
                    $return .= '<ul>';
                }
            }

            foreach ($items as $item) {
                $return .= is_array($item) ? self::render($item, $type, false) : (count($items) > 1 ? "<li>$item</li>" : $item);
            }

            if ($wrap) {
                if (count($items) > 1) {
                    $return .= '</ul>';
                }
                $return .= '</div>';
            }
        }

        return $return;
    }
}
