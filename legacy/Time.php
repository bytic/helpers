<?php

/**
 * Class Nip_Helper_Time
 * @deprecated use \Nip\Utility\Time
 */
class Nip_Helper_Time extends Nip\Helpers\AbstractHelper
{
    use \Nip\Utility\Traits\SingletonTrait;

    public function parseMinutes($time = false)
    {
        $minutes = false;
        if (strpos($time, ':')) {
            list($hours, $minutes) = explode(':', $time);
            $minutes += $hours * 60;
        }

        return $minutes;
    }

    /**
     * @param $seconds
     * @return string
     * @deprecated use \Nip\Utility\Time::fromSeconds($seconds)->getFormatedString()
     */
    public function secondsInStringTime($seconds): string
    {
        return \Nip\Utility\Time::fromSeconds($seconds)->getFormatedString();
    }
}
