<?php
header("Content-Type:text/html;charset=utf-8");





$arr = array("a","b");


try{
a($arr);
}
catch (\Exception $ex){
    echo $ex->getMessage() . $ex->getTraceAsString();
}

echo "aaa";


function testa($index ,$data){
    
    if(!key_exists($index, $data))
        throw new Exception("键名不存在");
    echo $data[$index];
    echo __FUNCTION__;
}


function a($data){
    testa(11,$data);
    
    echo __FUNCTION__;
}


