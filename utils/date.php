<?php
print_r( new \DateTime('now', new \DateTimeZone('Asia/Chongqing')) );
date_default_timezone_set('UTC');

print_r( new \DateTime() );
echo date_default_timezone_get();
echo time() . "\r\n";
echo date('Y-m-d H:i:s',time() ) . "\r\n";
echo strtotime(time() ) . "\r\n";