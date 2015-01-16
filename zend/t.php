<?php
set_time_limit(0);
define("SUM", 500);
header("Content-type:text/html;charset=gbk");

$tokenId = 'c0964686-543c-11e4-b143-2c44fd924984';

$header=array();
$header['accesstoken'] = $tokenId;
$header['accesstoken'] = $tokenId;
$httpRequestConfig = array('ssltransport' => 'tls',
        'adapter'=>'Zend_Http_Client_Adapter_Curl',
        'curloptions'=>array(CURLOPT_SSL_VERIFYPEER=>false));
$includePath = substr(__FILE__,0,-9) . PATH_SEPARATOR . get_include_path();
set_include_path($includePath);
require_once('Zend/Http/Client.php');
$arr = array();
$arr[] = mb_convert_encoding('查询9006数据', "GBK",'UTF-8') ;



    $url="http://ypk.39.net/yaopin/zty/jrztkyy/796d8.html";
    $httpClient = new Zend_Http_Client($url, $httpRequestConfig);
    $httpClient->setHeaders($header);
    $params = array('vcardid'=>'Ac8XYmPa75pD73dv5h7PB8BqRttz79oo');
    //$httpClient->setParameterGet($params);
    
    $httpResponse = $httpClient->request("GET");
   
 echo  $httpResponse->getBody();