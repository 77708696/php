<?php

$nums = array(1,2,3,4);

print_r( array_map('add', $nums) );

function add($v)
{
    return $v * $v;
}