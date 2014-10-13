<?php
var_dump( validateDate( '2015-05-01','Y-m-d'));

var_dump(ini_get("magic_quotes_gpc"));

$email = 'FENGDINGBO@y.com';

var_dump( filter_var($email,FILTER_VALIDATE_EMAIL));


print_r(filter_list());

//var_dump($_SERVER);
//foreach ( array_keys($_SERVER) as $b ) {
//    var_dump($b, filter_input(INPUT_SERVER, $b));
//}
echo '<hr>';


function CheckAdditional($value)
{
    return date('Y-m-d', strtotime($value)) == $value;
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}