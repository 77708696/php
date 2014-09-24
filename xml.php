<?php

$simple = simplexml_load_file('AccountBasic.orm.xml');

print_r($simple);



$fieldobj = $simple->fields;
print_r($fieldobj);
$arr = array();
foreach ($fieldobj as $item){
    $arr[] = (array)$item;
}

print_r($arr);

