<?php 
/**
 * 通过引用并调用 geetestlib 中的函数，进行服务器端验证，从而决定提交按钮后的行为
 * 本文件示例只是简单的输出 Yes or No
 */
require_once('geetestlib.php');

$validate_response = geetest_validate(@$_POST['geetest_challenge'], @$_POST['geetest_validate'], @$_POST['geetest_seccode']);
if ($validate_response) {
	echo 'Yes!';
} else {
	echo 'No';
}

?>