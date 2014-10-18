<?php
set_time_limit(0);
define("SUM", 500);
header("Content-type:text/html;charset=utf-8");

$tokenId = 'c0964686-543c-11e4-b143-2c44fd924984';
$tokenId = 'aaaaa';
$vcard = 'BEGIN:VCARD
VERSION:4.0

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
    $url="http://www";
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
    $url="http://192.168.30.191/cct";
    $httpClient = new Zend_Http_Client($url, $httpRequestConfig);    
    $httpClient->setHeaders($header);
    $httpResponse = $httpClient->request("GET");
    //print_r($httpResponse);
    $runtime_stop = microtime(true);
    $arr[] = intval(round($runtime_stop-$runtime_start,6) * 1000);
    //break;
}
fputcsv($fp,$arr);
fclose($fp);



//echo "<!-- Processed in ".round($runtime_stop-$runtime_start,6)." second(s) -->";