<?php
$redis = new Redis();
$redis->connect("192.168.30.191","6379");

$redis->set("userId:1001","huang");


var_dump( $redis->exists("userId:1001") );

echo $redis->get("userId:1001");

echo $redis->dbSize();