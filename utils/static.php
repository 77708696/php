<?php
function test(){
    
    static $a ;
    $a=$a+1;
    
    return  $a;
}

class A {
    
    private static $count = 5;
    
    public function __construct() {
        self::$count--;
    }
    
    public function getCount() {
        return self::$count;
    }
}
function total($sum) {
    static $total = 0;
    static $a=0;
    $total++;
    $a = $a + $total;
    if($total<$sum)
        total($sum);
    
    return $a;
    
}

$a = new A();
echo $a->getCount();

$a = new A();
echo $a->getCount();

echo test();
echo "\r\n";
echo total(10);