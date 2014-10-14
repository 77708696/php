<?php
class A{
    
    public function create1(){
        return new self();
    }
    
    public function create2(){
        return new static();
    }
    
    public function tostring()
    {
        return __CLASS__;
    }
}

class B extends A{
    
    public function tostring()
    {
        return __CLASS__;
    }
    
}



class U{
    public static function Create(){
        return new static();
    }
}

class u1 extends U{
    
    public function tostring(){
        echo __CLASS__;
    }
}
class u2 extends U{
    public function tostring(){
        echo __CLASS__;
    }
}

$ua = u1::Create();
$ua->tostring();

$b = new B();


var_dump(get_class($b),get_class($b->create1()) ,get_class($b->create2())
,$b->tostring(),
$b->create1()->tostring() );