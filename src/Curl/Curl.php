<?php
namespace Oliver\Curl;

use Oliver\Curl\CurlInterface;

/**
 *
 */
class Curl implements CurlInterface
{

    public function fetchData(array $urls) : array
    {
        $ch = [];
        $mh = curl_multi_init();

        for ($i=0; $i < count($urls); $i++) {
            $ch[$i] = curl_init($urls[$i]);
            curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($mh, $ch[$i]);
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        $results = [];
        for ($i=0; $i < count($ch); $i++) {
            $results[] = (json_decode(curl_multi_getcontent($ch[$i]), true));
        }
        return $results;
    }
}
