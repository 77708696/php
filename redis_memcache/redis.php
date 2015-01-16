<?php

$redis = new Redis();
$redis->connect("192.168.30.191","6379");

print_r($redis->zRange("zset",0,-1,true));

echo $redis->zRank('zset','one');

exit();
test($redis);

/**
 * 
 * @param Redis $redis
 */
function test(& $redis){

  print_r(  $redis->pipeline()->exec(array('cluster nodes')));
}
exit();
//$redis->select("1");
try{
    $redis->set("X","huang");
    

    echo $redis->get("userId:1001");
    echo $redis->get("X");
    echo "aaa";
}
catch(RedisException $ex)
{
    echo $ex->getMessage();
}
exit();

var_dump( $redis->exists("userId:1001") );

echo $redis->get("userId:1001");

echo $redis->dbSize();
$key="login_session:ANNxM0UZlnUrVqsweXi10wXL5RKGk00000000020";
//hash
$redis->hMset($key,
        
          array('f4'=>1,'f5'=>2)
         );



$gethash = $redis->hMget($key,array('f4'));
var_dump($gethash);

var_dump($redis->hKeys($key));
var_dump($redis->hVals($key));

test_list($redis);
/**
 * 
 * @param Redis $redis
 */
function test_list(& $redis)
{
    $array = array();
    for($i=0;$i<10;$i++)
        $array[] ="test" . $i;
    
    var_dump($array);
    $serialize_array = serialize($array);
    var_dump( $serialize_array );
    
    $un_serialize = unserialize($serialize_array);
    
    var_dump($un_serialize);
    
    $redis->sAdd("mzset",$serialize_array);
    
    $mzset = $redis->sMembers("mzset");
    $redis->sAdd("mzset",'1');
    var_dump($mzset);
    
    var_dump( unserialize($mzset[0]));
    
    $redis->srem("mzset",$mzset[0]);
}

/**
 * 
 * @param Redis $redis
 */
function test_set(& $redis){
    for($i=0;$i<10;$i++)    
        $redis->sAdd("myset","test" . $i);
    
    $myset = $redis->sMembers("myset");
    var_dump($myset);
    
    $mkey = $redis->sUnion(array('key1','key2'));
    
    var_dump($mkey);
    
}

