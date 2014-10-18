<?php
set_time_limit(0);
define("SUM", 500);
header("Content-type:text/html;charset=utf-8");

$tokenId = 'c0964686-543c-11e4-b143-2c44fd924984';
$tokenId = 'aaaaa';
$vcard = 'BEGIN:VCARD
VERSION:4.0
N:张;小白
FN:张小白
ORG:xx限公司;终端研发部
TITLE:安卓开发工程师
TEL;WORK;VOICE;PREF=1:+86 13322333322
TEL;WORK;VOICE;PREF=2:+86 13322333333
TEL;HOME;VOICE:+86 0102533323 x 808
TEL;CELL;VOICE:+86 13323232323
ADR;WORK;PREF:1号院;北京市朝阳区;;;中国
LABEL;WORK;PREF:北京市朝阳区1号院
X-MS-OL-DEFAULT-POSTAL-ADDRESS:2
URL;WORK:www.baidu.com
EMAIL;PREF;INTERNET:xx@aa.com
EMAIL;INTERNET:xx@aa.com
REV:20140807T081231Z
END:VCARD
    ';
$header=array();
$header['accesstoken'] = $tokenId;
$httpRequestConfig = array('ssltransport' => 'tls',
        'adapter'=>'Zend_Http_Client_Adapter_Curl',
        'curloptions'=>array(CURLOPT_SSL_VERIFYPEER=>false));
$includePath = substr(__FILE__,0,-9) . PATH_SEPARATOR . get_include_path();
set_include_path($includePath);
require_once('Zend/Http/Client.php');
$arr = array();
$arr[] = mb_convert_encoding('查询9006数据', "GBK",'UTF-8') ;
for($i=0;$i<SUM;$i++){
    $runtime_start = microtime(true);
    $url="http://192.168.30.191:9006/contact";
    //$url = "http://localhost/oradtdev/web/app_dev.php/contact";
    //$url="http://192.168.30.191/contact";
    $httpClient = new Zend_Http_Client($url, $httpRequestConfig);
    $httpClient->setHeaders($header);
    $params = array('vcardid'=>'Ac8XYmPa75pD73dv5h7PB8BqRttz79oo');
    //$httpClient->setParameterGet($params);
    
    $httpResponse = $httpClient->request("GET");
    //print_r($httpResponse);
    $runtime_stop = microtime(true);
    $arr[] = intval(round($runtime_stop-$runtime_start,6) * 1000);
    //break;
}
$fp = fopen('G:/file.csv', 'w');
fputcsv($fp,$arr);
$arr = array();
$arr[] = mb_convert_encoding('查询数据', "GBK",'UTF-8') ;
for($i=0;$i<SUM;$i++){
    $runtime_start = microtime(true);
    $url="http://192.168.30.191/contact";
    $httpClient = new Zend_Http_Client($url, $httpRequestConfig);    
    $httpClient->setHeaders($header);
    $httpResponse = $httpClient->request("GET");
    //print_r($httpResponse);
    $runtime_stop = microtime(true);
    $arr[] = intval(round($runtime_stop-$runtime_start,6) * 1000);
    //break;
}
fputcsv($fp,$arr);



$arr = array();
$arr[] = mb_convert_encoding('写数据9006数据', "GBK",'UTF-8') ;
for($i=0;$i<SUM;$i++){
    $params = array('contact'=>'秦以a' . $i,
            'vcard' => $vcard,
            'remark' => ''
    );
    $runtime_start = microtime(true);
    $url="http://192.168.30.191:9006/contact";
    $httpClient = new Zend_Http_Client($url, $httpRequestConfig);    
    $httpClient->setHeaders($header);    
    $httpClient->setParameterPost($params);
    $httpClient->setFileUpload('D:/vcf/yyyyy.zip', "cardres");
    $httpResponse = $httpClient->request("POST");
    $runtime_stop = microtime(true);
    $arr[] = intval(round($runtime_stop-$runtime_start,6) * 1000) ;
    //break;
}
fputcsv($fp,$arr);

$arr = array();
$arr[] = mb_convert_encoding('写数据数据', "GBK",'UTF-8') ;
for($i=0;$i<SUM;$i++){
    $params = array('contact'=>'秦以a' . $i,
            'vcard' => $vcard,
            'remark' => ''
    );
    $runtime_start = microtime(true);
    $url="http://192.168.30.191/contact";
    $httpClient = new Zend_Http_Client($url, $httpRequestConfig);
    $httpClient->setHeaders($header);
    $httpClient->setParameterPost($params);
    $httpClient->setFileUpload('D:/vcf/yyyyy.zip', "cardres");
    $httpResponse = $httpClient->request("POST");
    $runtime_stop = microtime(true);
    $arr[] = intval(round($runtime_stop-$runtime_start,6) * 1000) ;
    //break;
}
fputcsv($fp,$arr);
fclose($fp);



//echo "<!-- Processed in ".round($runtime_stop-$runtime_start,6)." second(s) -->";