<?php
abstract class Application {
    
    private static $count = 5 ;
    private static $time = null;
    public function __construct(){
        echo __CLASS__;
        self::$count--;
        if(self::$time===null)
            self::$time = time();
    }
    
    public function getCount(){
        return self::$count;
    }
}