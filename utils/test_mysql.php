<?php
include 'mysql.php';
$config = array('host' => 'localhost','port' => 3306,'username'=>'root','password'=>'123456','dbname'=>'test',
        'charset'=>'GBK'
);
//初始化
$db = new dbMysql($config);
print_r($config);

$sql="insert into contact (contact_name,group_id,created_time) values ('a','d','2014-12-12')";
//执行insert
$db->query($sql);
//获取自增ID
$lastID = $db->getLastInsertID();

echo $lastID;