<?php
/**
  	查找数组交集
 */
$array1 = array(1=>'a','b','c');

$array2 = array('d','b','f','c');


print_r( array_intersect( $array1, $array2 ) );