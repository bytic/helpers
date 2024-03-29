<?php

/**
 * Class Nip_Helper_Strings
 */
class Nip_Helper_Strings extends Nip\Helpers\AbstractHelper
{

    /**
     * Limits a string to a certain number of words
     *
     * @param string $string
     * @param int $limit
     * @param string $end
     *
     * @return string
     */
    public function limitWords($string, $limit = false, $end = '...')
    {
        $words = explode(" ", $string);

        if (count($words) <= $limit) {
            return $string;
        }

        $return = [];
        for ($wordCount = 0; $wordCount < $limit; $wordCount++) {
            $return[] = $words[$wordCount];
        }

        $return[] = $end;

        return implode(" ", $return);
    }


    /**
     * Injects GET params in links
     *
     * @param string $string
     * @param array $params
     *
     * @return string
     */
    public function injectParams($string, $params = array())
    {
        $links = preg_split('#(<a\b[^>]+>)#', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
        $old   = $links;

        foreach ($links as &$match) {
            if (preg_match('/<a\b/', $match) && ! preg_match('/(?:#|mailto)/', $match)) {
                preg_match('/^([^"]+")([^"]+)/', $match, $matches);
                if ($matches) {
                    $link = html_entity_decode($matches[2]);
                    if (strpos($link, "?") === false) {
                        $link .= "?";
                    } else {
                        $link .= "&";
                    }

                    $link .= http_build_query($params);

                    $match = str_replace($matches[2], $link, $match);
                }
            }
        }

        $string = str_replace($old, $links, $string);

        return $string;
    }


    /**
     * Converts all relative hrefs and image srcs to absolute
     *
     * @param string $string
     * @param string $base
     *
     * @return string
     */
    public function relativeToAbsolute($string, $base)
    {
        $matches = preg_split('#(<(a|img)\b[^>]+>)#', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
        $old     = $matches;

        foreach ($matches as &$match) {
            if (preg_match('/<(a|img)\b/', $match) && ! preg_match('/(?:http|#|mailto)/', $match)) {
                $match = preg_replace('/^([^"]+")([^"]+)/', '$1' . $base . '$2', $match);
            }
        }

        $string = str_replace($old, $matches, $string);

        return $string;
    }

    /**
     * @param $number
     *
     * @return string
     */
    public function moneyFormat($number)
    {
        return money_format('%n', $number);
    }

    /**
     * @param $time
     *
     * @return float|int|mixed
     */
    public function cronoTimeInSeconds($time)
    {
        return (new \Nip\Utility\Time\Duration($time))->getSeconds();
    }

    /**
     * @param $seconds
     * @return string
     * @deprecated \Nip\Utility\Time::fromSeconds($seconds)->getDefaultString()
     */
    public function secondsInCronoTime($seconds)
    {
        return \Nip\Utility\Time::fromSeconds($seconds)->getDefaultString();
    }
}
