<?php
include 'spider.class.php'; 

$url="http://ypk.39.net/yaopin/zty/jrztkyy/796d8.html";
//$url="http://m.120ask.com/";

echo file_get_contents($url);exit();
$htmlView = DAQURLContentBySocket($url);
//$htmlView = mb_convert_encoding( $htmlView, 'gb2312', 'UTF-8'); 
 
 echo $htmlView;
  

?>