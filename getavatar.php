<?php
$opts = array(
        'http'=>array(
                'method'=>"GET",
                'header'=>"accesstoken: aaaaa\r\n"
        )
);
//"avatar": "http://192.168.30.191/account/avatar?path=j2TMgzK8Yfk4NDuRpP6yFqZRepWTBA6mTHZKfIIM/BnxxSoZtUP20140925101937.jpg"
$context = stream_context_create($opts);


$file = file_get_contents('http://192.168.30.191/account/avatar?path=j2TMgzK8Yfk4NDuRpP6yFqZRepWTBA6mTHZKfIIM/BnxxSoZtUP20140925101937.jpg', false, $context);

//var_dump($context);

$jsondata = json_decode($file);


if(empty($jsondata))
{
    header('Content-type: image/jpg');
    echo $file;
}
else
{
    var_dump($jsondata);
}