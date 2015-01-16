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
$user1 = new user();
$user2 = new user();
$user3 = new user();
echo "now here have ".$user1->getCount()." user";
echo "<br>";
unset( $user3);
echo "now here have ".$user2->getCount()." user";