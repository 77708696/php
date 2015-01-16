<?php
header("Content-Type:text/html;charset=utf-8");


$a = "
| 100 |
| 101 |
| 102 |
| 103 |
| 104 |
| 106 |
| 111 |
| 112 |
| 113 |
| 114 |
| 116 |
| 120 |
| 126 |
| 129 |
| 139 |
| 141 |
| 144 |
| 157 |
| 167 |
| 175 |
| 183 |
| 187 |
| 189 |
| 192 |
| 194 |
| 203 |
| 204 |
| 216 |
| 217 |
| 218 |
| 222 |
| 223 |
| 228 |
| 229 |
| 233 |
| 234 |
| 245 |
| 256 |
| 266 |
| 276 |
| 284 |
| 289 |
| 291 |
| 293 |
| 297 |
| 298 |
| 299 |
| 301 |
| 312 |
| 319 |
| 320 |
| 324 |
| 325 |
| 328 |
| 341 |
| 350 |
| 375 |
| 405 |
| 417 |
| 426 |
| 430 |
| 432 |
| 437 |
| 438 |
| 439 |
| 440 |
| 448 |
| 456 |
| 460 |
| 461 |
| 465 |
| 468 |
| 470 |
| 471 |";

$arr = explode("\r\n", $a);
foreach ($arr as $s){
    if(empty($s))
        continue;
    echo sprintf("delete from fke_houserent_%d where broker_id>0 and created>=1417363200 and house_title like",substr($s, 2,3) ) . " '%哪家%';\r\n";
    
}
exit();

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