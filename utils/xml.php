<?php

include 'format.php';

$simple = simplexml_load_file('msg.xml');

print_r($simple);

$fields = 'id,messageid,sender';
//$fields = 'avatarid';
$fields_array = (array)$simple->fields;

$provideFields =  array_keys( $fields_array ) ;



print_r($provideFields);


$fields_arr = explode(',', $fields);

$result_fields = array_intersect($fields_arr,$provideFields) ;

print_r($result_fields);

//字段映射
$result_fields_str = '';

foreach($result_fields as $v)
{
    if($fields_array[$v]->mapdb==$v)
        $result_fields_str.= $fields_array[$v]->mapdb .',';
    else 
        $result_fields_str.= $fields_array[$v]->mapdb .' AS '.$v.',';
}
$result_fields_str = rtrim($result_fields_str,',');

//where拼接
$where = (string)$simple->where;
$order = (string)$simple->order;

if(!empty($where))
{
    $where=' WHERE ' . ltrim(trim($where), 'and');
}
//echo (string)$simple->sql;exit();
//接sql
$sql = format($simple->sql,$result_fields_str,$where,$order);

$a = array_filter($fields_array,'filterWhereFiled');
print_r($a);

echo $sql;


function filterWhereFiled($item)
{
    if($item->w==1)
        return true;
    return false;
}














