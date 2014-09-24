<?php
$nums = array(10, 20, 30, 40);

print_r( array_filter($nums, function ($v){ return $v>15; } ) );
    