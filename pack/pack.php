<?php
// http://randomclan.blog.163.com/blog/static/1453009820125454418912/
$code=array(

        "username"=>array("A20","张三adfb12"),

        "pass"=>array("A10","asdf*#1"),

        "age"=>array("C","23"),

        "birthday"=>array("I","19900101"),

        "email"=>array("A50","zhangsan@163.com"));

$stream=join("\0",packByArr($code));

echo $stream,strlen($stream);



file_put_contents("1.txt",$stream);    //将流保存起来便于下面读取



function packByArr($arr)  {

    $atArr=array();

    foreach ($arr as $k=>$v) {

        $atArr[]=pack($v[0],$v[1]);

    }

    return $atArr;

}

function getAscill($str) {

    $arr=str_split($str);

    foreach ($arr as $v) {

        echo $v,"=",ord($v),"\n";

    }

}