<?php
class user{
    private static $count = 0 ; //记录所有用户的登录情况.

    public function __construct(){
        self::$count = self::$count + 1;
    }
    public function getCount(){
        return self::$count;
    }
    public function __destruct(){
        self::$count = self::$count -1;
    }
}

class Basic extends user{
    
}

$basic = new Basic();
$user1 = new user();
$user2 = "";


var_dump( $user2 instanceof user);

var_dump( $user1 instanceof user);
var_dump( $basic instanceof user);