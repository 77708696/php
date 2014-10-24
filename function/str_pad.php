<?php
$str = '109';

echo $str . "\n";


$str2 = str_pad($str, 11,'0',STR_PAD_LEFT);

echo $str2 . "\n";
$str2 = ltrim($str2,'0');
echo $str2 . "\n";

echo ($str2>>1);