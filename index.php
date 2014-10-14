<?php
phpinfo();
exit();
$str = 'www.yipu.com.cn';

echo ltrim( strchr($str,'.'),'.' );
exit();

var_dump( stripos( $_SERVER['HTTP_HOST'] , 'yipu.com.cn') );

print_r($_SERVER);

exit();
echo "<br><br><br><br><br>";

echo crc32("abc") . "\r\n";

$binary = "11111001";
$hex = dechex(bindec($binary));
echo $hex;
echo print_r($_SERVER);