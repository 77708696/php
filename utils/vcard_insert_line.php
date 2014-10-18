<?php
//vcf后面
header("Content-type:text/html;charset=utf-8");

echo strlen('0FjLng5hYnAuexIB26GO4fFc0PzORcEAEWxeFz2S');

echo "\n\n";

$vcard = 'BEGIN:VCARD
VERSION:4.0
N:张;小白
FN:张小白
ORG:XXX公司;ZZ部站
TITLE:安卓开发工程师
TEL;WORK;VOICE;PREF=1:+86 13322333322
TEL;WORK;VOICE;PREF=2:+86 13322333333
TEL;HOME;VOICE:+86 0102533323 x 808
TEL;CELL;VOICE:+86 13323232323
ADR;WORK;PREF:1号院;北京市朝阳区;;;中国
LABEL;WORK;PREF:北京市朝阳区1号院
X-MS-OL-DEFAULT-POSTAL-ADDRESS:2
URL;WORK:www.baidu.com
EMAIL;PREF;INTERNET:aaa@126.com
EMAIL;INTERNET:aaa2@126.com
USERID:1001
REV:20140807T081231Z
END:VCARD';
echo $vcard;
echo "\n--------------------------------------\n";
$vcards = explode("\n", $vcard);

array_splice($vcards, -1,1,array('UID:urn:userid:AwGjetnxKlpOqxZvnMQWeiUNXnyzbnCsQteVxMDF','END:VCARD'));

$vcard = implode("\n", $vcards);
echo $vcard;
print_r($vcards);