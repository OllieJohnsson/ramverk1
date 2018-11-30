<?php
namespace Oliver\Curl;

/**
 *
 */
interface CurlInterface
{
    function fetchData(array $urls) : array;
}
