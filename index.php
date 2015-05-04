<?php

$url = 'http://www.arkaroy.net';
$host = parse_url($url, PHP_URL_HOST);

$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url='.$url);
$alexa_rank=isset($xml->SD[1]->POPULARITY) ? $xml->SD[1]->POPULARITY->attributes()->TEXT : 0;
$web=(string)$xml->SD[0]->attributes()->HOST;

$social_popularity = array();

$twitter = json_decode(file_get_contents('https://cdn.api.twitter.com/1/urls/count.json?url=' . $url));
$social_popularity['twitter']['share'] = isset($twitter->count) ? $twitter->count : 0;
$stumbleupon = json_decode(file_get_contents('https://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url));
$social_popularity['stumbleupon']['view'] = isset($stumbleupon->result->views) ? $stumbleupon->result->views : 0;
echo json_encode($social_popularity);
