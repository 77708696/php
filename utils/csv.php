<?php

header('Content-Type:text/html;charset=utf-8');

$csvFile = '../list.csv';

$handle = fopen($csvFile ,'r');
$arr = array();
while (($data = fgetcsv($handle))!==false)
{
    $arr[] = $data;
}

fclose($handle);
array_shift($arr);
print_r($arr);



//商铺
$glist = <<<eof
%d=>array('ID'=>%d,'nTypeID'=>0,'nCtiyID'=>%d,'siteName'=>'58_%s__||',	'url'=>'http://m.exptime.org.cn/%s/shangpu/','rent_sort'=>1,'vid'=>8,'stype'=>'58com','ncutPH'=>0,'charset' => 'utf-8', 'url_list'=>str_replace(array('<a href="','"'), '',getlist0(%s,'~<a href=".+?"~is'))),
eof;

$glist = <<<eof
%d=>array('ID'=>%d,'nTypeID'=>1,'nCtiyID'=>%d,'siteName'=>'58_%s__||','rent_sort'=>1,'vid'=>8,'stype'=>'58com','ncutPH'=>0,'charset' => 'utf-8',		'url'=>'http://m.exptime.org.cn/%s/zhaozu/d1/','arp_arr'=> array("luoyang.exptime.org.cn"=>"m.exptime.org.cn/%s")),
eof;
$glist = <<<eof
%d=>array('ID'=>%d,'nTypeID'=>3,'nCtiyID'=>%d,'siteName'=>'58_%s__||',	'url'=>'http://m.exptime.org.cn/%s/fangchan/','rent_sort'=>1,'vid'=>8,'stype'=>'58com','ncutPH'=>0,'charset' => 'utf-8',   'url_list'=>str_replace(array('<a href="','"'), '',getlist0(%s,'~<a href=".+?"~is'))),
eof;
$i=26;
foreach ($arr as $v){
    //echo "\r\nupdate yipucommon_district_58  set Domain='" .$v[3]."',nsite=1 where id=" .$v[0].";";
   // echo "\r\n";
   // echo sprintf($glist,$v[0],$v[0],$v[0],$v[1],$v[2],'$html');
    echo "\r\n$i 2 * * * curl http://www.a.com.cn/{}/getlist_cf.php?ID=" . $v[0];
    $i++;
}



















$card_tb = "
CREATE TABLE `fke_houserent_%d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nTypeID` tinyint(4) NOT NULL DEFAULT '0' COMMENT '',
  `house_title` varchar(40) NOT NULL,
  `nCtiyID` int(4) NOT NULL DEFAULT '0' COMMENT 'ID',
  `cityarea_id` int(4) DEFAULT NULL COMMENT '',
  `cityarea2_id` int(4) DEFAULT NULL,
  `house_type` tinyint(4) NOT NULL,
  `house_no` varchar(20) NOT NULL,
  `house_price` float NOT NULL,
  `house_deposit` tinyint(4) DEFAULT '1',
  `house_totalarea` float DEFAULT '0',
  `house_room` tinyint(4) DEFAULT '0',
  `house_hall` tinyint(4) DEFAULT '0',
  `house_toilet` tinyint(4) DEFAULT '0',
  `house_veranda` tinyint(4) DEFAULT '0',
  `house_thumb` varchar(100) DEFAULT NULL,
  `house_topfloor` tinyint(4) DEFAULT '0',
  `house_floor` tinyint(4) DEFAULT '0',
  `nZhuce` tinyint(4) NOT NULL DEFAULT '0',
  `house_toward` tinyint(4) DEFAULT '0',
  `house_fitment` tinyint(4) DEFAULT '0',
  `borough_id` int(11) DEFAULT '0',
  `borough_name` varchar(100) DEFAULT NULL,
  `broker_id` int(11) DEFAULT '0',
  `adddate` int(11) DEFAULT '0',
  `drawing_id` int(11) DEFAULT '0',
  `is_share` tinyint(4) DEFAULT '0',
  `is_promote` tinyint(4) DEFAULT '2',
  `status` tinyint(4) DEFAULT '1',
  `house_downtime` int(11) DEFAULT '0',
  `is_checked` tinyint(4) DEFAULT '1',
  `order_weight` float DEFAULT '0',
  `update_order` int(11) DEFAULT '0',
  `tips_num` tinyint(4) DEFAULT '0',
  `click_num` int(11) DEFAULT '0',
  `tel_num` int(11) DEFAULT '0',
  `created` int(11) NOT NULL DEFAULT '0',
  `updated` int(11) DEFAULT '0',
  `is_index` tinyint(4) DEFAULT '0',
  `is_top` int(11) DEFAULT '0',
  `refresh` int(11) DEFAULT '2',
  `owner_name` varchar(100) DEFAULT NULL,
  `owner_phone` varchar(40) DEFAULT NULL,
  `is_more_pic` tinyint(4) DEFAULT NULL,
  `company_id` tinyint(4) DEFAULT NULL,
  `cAddress` varchar(120) NOT NULL COMMENT '地址',
  `industry1` int(11) DEFAULT NULL COMMENT '大类',
  `industry2` int(11) DEFAULT NULL COMMENT '小类',
  `industry` set('超市零售','餐饮美食','服饰鞋包','休闲娱乐','生活服务','家居建材','酒店宾馆','美容美发','电子通讯','其他') DEFAULT NULL,
  `feature` set('不可餐饮','没有下水','面积可分割','休闲娱乐','带货转让、不空转') DEFAULT NULL,
  `zhuan_price` float DEFAULT NULL,
  `rent_sort` tinyint(11) DEFAULT NULL,
  `price_danwei` tinyint(4) NOT NULL DEFAULT '0',
  `nPNum` int(11) NOT NULL DEFAULT '0',
  `nLng` varchar(20) NOT NULL,
  `nLat` varchar(20) NOT NULL,
  `nZoon` int(11) NOT NULL,
  `cItemName` varchar(60) NOT NULL,
  `forindustry` varchar(80) DEFAULT NULL,
  `isindependent` tinyint(11) DEFAULT NULL,
  `issublet` tinyint(11) DEFAULT NULL,
  `iselevator` tinyint(11) DEFAULT NULL,
  `supporting` varchar(80) DEFAULT NULL,
  `house_uptime` int(11) DEFAULT NULL,
  `house_thumb_mob` varchar(100) DEFAULT NULL,
  `cSource` varchar(20) NOT NULL DEFAULT '',
  `broker_id1` int(11) DEFAULT NULL,
  `cIP` varchar(20) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `broker_id` (`broker_id`),
  KEY `nCtiyID` (`nCtiyID`),
  KEY `created` (`created`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1997291 ;";

foreach ($arr as $v){
    //echo "\r\n\r\n";
    //echo sprintf($card_tb,$v[0]);
}


