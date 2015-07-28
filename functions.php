<?php

// Disse funksjonene er her for bruk i prosessen med å
// plukke ut selve bokbeskrivelsen fra <description>-tagen
// i rss-feeden fra bibliofil. Brukes kun dersom det ikke
// er noen krydderbeskrivelse.

function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

function is_empty($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}
?>
