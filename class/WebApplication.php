<?php
include 'Application.php';
class WebApplication extends Application {
    
    
    public function __construct(){
        parent::__construct();
        echo __CLASS__;
    }
    
    
}

$app = new WebApplication();
echo $app->getCount();
$app1 = new WebApplication();


echo $app1->getCount();

class utils{
    
    
    public static function  getDate(){
        
        return new \DateTime('now', new \DateTimeZone('UTC'));
        
    }
}