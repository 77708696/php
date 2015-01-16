<?php
class foo {
    public $value = 43;
    
    private $handel = null;
    private $str="";
    public function __construct(){
        
    }
    
    public function & getValue() {
        return $this->value;
    }
    
    public function log($str){
        $this->str .=sprintf("%s : %s \r\n" , date("Y-m-d H:i:s"), $str);
    }
    
    public function __destruct(){
        $handle = fopen("log.txt", "a+");
        fwrite($handle, $this->str);
        fclose($handle);
    }
    
}



$f = new foo();
$f->log("test");
$myValue = & $f->getValue();
$v2 = & $myValue;
$f->value = 4;
testf($f);
//$v2 = 55;
echo $myValue . "---" . $v2;

var_dump($f);
$f->log("close");
//unset($f);

function testf($class){
    $class->value=100;
    echo $class->value;
}