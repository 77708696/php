<?php

echo "<br><br><br><br><br>";
phpinfo();
exit();
echo crc32("abc") . "\r\n";

$binary = "11111001";
$hex = dechex(bindec($binary));
echo $hex;
echo print_r($_SERVER);