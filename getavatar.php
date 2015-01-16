<?php
$opts = array(
        'http'=>array(
                'method'=>"GET",
                'header'=>"accesstoken: aaaaa\r\n"
        )
);
//"avatar": "http://192.168.30.191/account/avatar?path=j2TMgzK8Yfk4NDuRpP6yFqZRepWTBA6mTHZKfIIM/BnxxSoZtUP20140925101937.jpg"
$context = stream_context_create($opts);


$file = file_get_contents('http://192.168.30.191/account/avatar?path=A2txslhbTjsRW5GZMrluD9sRzl5oW00000000013', false, $context);

file_put_contents("a.jpg", $file);