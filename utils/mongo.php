<?php
/** 
 * install mongodb 
 * 二进制的安装下载下来后直接运行即可 ，启动时需要指定--dbpath 目录，默认是在/data/db中
 * 
 * 
 * mongod --dbpath=/mongodata/masterdb --master --oplogSize 64 --port 5566  
 * mongod --slave --source 192.168.1.193:5566 --dbpath=/mongodata/slavedb --port 5567 --slavedelay 10 --only test --autoresync  
./mongod --dbpath /Data/data/mongodb -auth  启动mongodb
./mongo   
php extension install 
http://php.net/manual/zh/mongo.installation.php#mongo.installation.nix
windows 扩展下载  https://s3.amazonaws.com/drivers.mongodb.org/php/index.html
extension=php_mongo-1.5.7-5.4-vc9.dll;
  进入户端管理程序

 client
  集合可以有不同的字段
  db.people.find() 查询全部表数居
  db.col.find({a:'author'})
 
 
 */
//连接
$m = new MongoClient("mongodb://sa:123456@192.168.30.191:27017");

$db = new MongoDB($m, 'test');

gridFS($db);

function gridFS(&$db){
    $gridfs = $db->getGridFS("txt");
    $id = $gridfs->storeFile('D:\\dropkey.txt', array('contentType' => 'plain/text'));
    getFile ($db, $id);
}
function getFile(&$db,$id){
    $gridfs = $db->getGridFS("txt");
    //$id ='545ae51be40a6f1c19000069';
    //$gridfs->storeFile('D:\\dropkey.txt', array('contentType' => 'plain/text'));
    $obj = $gridfs->findOne( array('_id'=> new MongoId($id))) ;
    
    print_r($obj->file);
    // exit();
    //  exit();
    //  echo $id;
    // $gridfsFile = $gridfs->get($id);
    $stream = $obj->getResource();
    //print_r($stream);
    while (!feof($stream)) {
        echo fread($stream, 8192);
    }
}

function insert(&$db){
//insert 
    $people = $db->people;
    $people->insert(array("name" => "Joe1", "age" => 41));
    $people->insert(array("name" => "Sally", "age" => 22));
    $people->insert(array("name" => "Dave", "age" => 22));
    $people->insert(array("name" => "Molly", "age" => 87));
    /**/

}
function showlist(&$db){
//list   

    $list = $db->selectCollection("people")->findOne();
    foreach ($list as $user) {
        print_r($user);
    }
}
