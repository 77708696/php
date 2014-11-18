<?php
$vcard = 'Aqvd18gdyWsWrUBgZrqUbdAzCFlOBZAm,BAJ42YurxI7isud545IxFknKitwLoMz8';

$arr = explode(',', $vcard);
print_r($arr);

echo "'" .implode("','", explode(',', $vcard)) . "'";
$inArr = array();
for ($i=0;$i<count($arr);$i++){
    $key = ":where_in_" . $i;
    $inArr[] = $key;
    echo "\r\n" . $arr[$i] . "\r\n";
}

print_r($inArr);

echo implode(',', $inArr);