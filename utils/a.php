<?php
header("content-type:text/html; charset=utf-8"); //设置编码
$xml = simplexml_load_file('a.xml');  //载入xml文件 $lists和xml文件的根节点是一样的

print_r($xml);

echo $xml->company."<br>";
echo $xml->town."<br>id:";
echo $xml->town[id]."<br>parent:";

echo "<br>循环读取:<br>";
foreach($xml->user as $users){     //有多个user，取得的是数组，循环输出
    echo "-------------------<br>";
    echo "姓名:".$users->name."<br>";
    echo "编号:".$users->age."<br>";
    echo "性别:".$users->age[sex]."<br>";
    echo "序号:".$users->height."<br>";
}
echo "<br>循环读取:<br>";
foreach($xml->town as $towns){     //有多个user，取得的是数组，循环输出
    echo "-------------------<br>";
    echo "id:".$towns[id]."<br>";

    echo "地区:".$towns."<br>";
}