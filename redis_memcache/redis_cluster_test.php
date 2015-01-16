<?php
include 'RedisCluster.php';
function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol)-1;

    for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }

    return $str;
}
echo getRandChar(4);
echo "test cluster";


$cluster = array(
         'nodes' => array(
                 'node_1' => array('host' => '192.168.30.104', 'port' => 6379),
                 'node_2' => array('host' => '192.168.30.105', 'port' => 6379),
                 'node_3' => array('host' => '192.168.30.106', 'port' => 6379)
        )
        );
$r = new RedisCluster\RedisCluster($cluster, 1);
//echo $r->set("X","aaa1111111111");
//$r->set("xxx1","aaa1111111111");
//echo $r->get("xxx1");
//exit();

for($i=0;$i<50;$i++){
    $key=getRandChar(4);
    $result = $r->set($key,getRandChar(4));
    if(empty( $result ) )
        echo $key . "\n";
}
   


print_r($r->keys());