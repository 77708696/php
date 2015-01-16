<?php
include 'PRedisCluster.php';

$runtime_start = microtime(true);
$predis = new PRedisCluster('192.168.30.104');

$keys = $predis->keys('*');
print_r($keys);
echo count($keys) . "\n";exit();
$predis->sadd('stest',array('aaa','bbb','ccc'));

exit();
for($i=0;$i<1650;$i++){
    $key=getRandChar(4);
    $result = $predis->set($key,getRandChar(4));
    if(empty( $result ) )
        echo $key . "失败\n";
}









/*

foreach ($keys as $k)
    $value = $predis->get($k) . "\n";
*/
$runtime_stop = microtime(true);
echo intval(round($runtime_stop-$runtime_start,6) * 1000) . "\r\n";



exit();

   


function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol)-1;

    for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }

    return $str;
}