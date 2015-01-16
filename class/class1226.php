<?php
class user{

    public function test($s){
        echo __CLASS__;
    }
}


class basic extends user {
    public function test($s){
        if(empty($s))
            throw new Exception("root");
        echo __CLASS__;
    }
}



$u = new basic();
try{
    $u->test('');
}
catch (Exception $ex){
    print_r($ex);
}

$str='huang';

$f = function($d) {
    echo $d . $str;
};

$f('a');