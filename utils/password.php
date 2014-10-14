<?php
/**
 * 
 * @param string $password
 * @param number $len
 * @return number level 0-4  0不符合长度 1 只有一类字符 
 */
function secureLevel($password,$len=6){
    $score = 0;
    if($password=='123456' || strlen($password) < 6)
        return $score;
    //"/[a-z]{3,}/"
    if(preg_match("/^[a-z]+$/",$password) || preg_match("/^[A-Z]+$/",$password) || preg_match("/^[0-9]+$/",$password))
    {
        return 1;
    }
    if(preg_match("/[0-9]+/",$password))
    {
        $score ++;
    }
    if(preg_match("/[a-z]+/",$password))
    {
        $score ++;
    }
    if(preg_match("/[A-Z]+/",$password))
    {
        $score ++;
    }
    if(preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)]+/",$password))
    {
        $score ++;
    }
    return $score;
}
echo secureLevel("1234561aZ_");