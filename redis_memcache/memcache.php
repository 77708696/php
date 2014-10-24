<?php
$m = new Memcache();
$m->addserver("192.168.30.191","11211");

//$m->set("foo","test");

print_r($m->get("foo"));


$md = new Memcached();