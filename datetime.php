<?php

$date = new \DateTime( 'now',  new \DateTimeZone( 'UTC' ) );

print_r($date);
echo $date->format("Y-m-d\TH:i:s\Z");
echo "\r\n";
echo gmDate("Y-m-d\TH:i:s\Z",time());