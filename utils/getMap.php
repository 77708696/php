<?php
header("Content-Type:text/html;charset=utf-8");

function checkTelephone($C_telephone)
{
    if (!preg_match("/^0{0,1}(13[0-9]|15[0-9]|18[0-9])[0-9]{8}$/", $C_telephone))
        return false;
    return true;
}


$mobile = empty($_GET['m']) ? '13761953926' : $_GET['m'];

if(checkTelephone($mobile)){
    $mobileurl = 'http://v.showji.com/locating/showji.com1118.aspx?m='.$mobile.'&output=json&timestamp=' . time();
    
    $html = file_get_contents($mobileurl);
    $json = json_decode($html ,true);
    var_dump( $json );
    $address = $json['City'];
}else{
    $address = $mobile;
}
/**
 * http://v.showji.com/locating/showji.com1118.aspx?m=13761953926&output=json
 * http://api.map.baidu.com/geocoder/v2/?address=北京&output=json&ak=PyK7dwXaQe9At6SQ9AQ7KwGQ
Array
(
    [Mobile] => 13522723158
    13820757738
    [QueryResult] => True
    [TO] => 中国移动
    [Corp] => 中国移动
    [Province] => 北京
    [City] => 北京
    [AreaCode] => 010
    [PostCode] => 100000
    [VNO] => 
    [Card] => 
)
{"status":0,"result":{"location":{"lng":116.39564503788,"lat":39.92998577808},"precise":0,"confidence":10,"level":"\u57ce\u5e02"}}

*/
$maphtml = file_get_contents("http://api.map.baidu.com/geocoder/v2/?address=".$address."&output=json&ak=PyK7dwXaQe9At6SQ9AQ7KwGQ");

$mapJson = json_decode($maphtml,true);
print_r($mapJson);
$location = $mapJson['result']['location'];
$lng_lat = $location['lng'] .','.$location['lat'];
echo '<img src="http://api.map.baidu.com/staticimage?center='.$lng_lat.'&markers='.$lng_lat.'&zoom=11">';
?>