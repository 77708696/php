<?php

echo crc32("abc") . "\r\n";

$binary = "11111001";
$hex = dechex(bindec($binary));
echo $hex;