<?php
//vcf后面
header("Content-type:text/html;charset=utf-8");

echo strlen('0FjLng5hYnAuexIB26GO4fFc0PzORcEAEWxeFz2S');

echo "\n\n";

$vcard = 'BEGIN:VCARD
VERSION:4.0
END:VCARD';
echo $vcard;
echo "\n--------------------------------------\n";
$vcards = explode("\n", $vcard);

array_splice($vcards, -1,1,array('auserId:tNXnyzbnCsQteVxMDF','END:VCARD'));

$vcard = implode("\n", $vcards);
echo $vcard;
print_r($vcards);