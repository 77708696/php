<?php
// http://randomclan.blog.163.com/blog/static/1453009820125454418912/
header("Content-Type:text/html;charset=utf-8");
$code=array(

        "username"=>array("A20"),

        "pass"=>array("A10"),

        "age"=>array("C"),

        "birthday"=>array("I"),

        "email"=>array("A50"));

$stream=file_get_contents("1.txt");

print_r(packByArr($stream,$code));

function packByArr($str,$code) {

    $Arr=explode("\0",$str);

    $atArr=array();

    $i=0;

    foreach ($code as $k=>$v) {

        $atArr[$k]=unpack($v[0],$Arr[$i]);

        $i++;

    }

    return $atArr;

}