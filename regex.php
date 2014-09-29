<?php
$regex = '/http:\/\/([\w.]+)\/([\w]+)\/([\w]+)\.html/i';
$str = 'as8779001fasdfasdfasdfhttp://www.youku.com/show_page/id_ABCDEFG.htmlasdfas13522723158df14722723158asdfasd';
$matches = array();



var_dump( 
preg_replace(array( "/[\d]{11}/","/[\d]{8}/","/[\d]{7}/"), array('***********','********','*******'), $str)); exit();

if(preg_match($reg1, $str, $matches)){
	var_dump($matches);
}