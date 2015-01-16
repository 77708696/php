<?php 
header("content-type:text/html; charset=utf-8");
//header("Content-Type:text/html; charset=gbk");

$socket = @stream_socket_client('192.168.30.104:6379',$errorNumber,$errorDescription,50);

var_dump($socket);
var_dump(executeCommand($socket,'keys',array('*')) );


function executeCommand(& $socket ,$name,$params=array())
	{
		array_unshift($params,$name);
		$command='*'.count($params)."\r\n";
		foreach($params as $arg)
			$command.='$'.strlen($arg)."\r\n".$arg."\r\n";

		fwrite($socket,$command);

		return parseResponse(implode(' ',$params));
	}
function parseResponse()
	{
    global $socket;
		if(($line=fgets($socket))===false)
			throw new Exception('Failed reading data from redis connection socket.');
		$type=$line[0];
        echo urlencode($line) . '________';
		$line=substr($line,1,-2);
		switch($type)
		{
			case '+': // Status reply
				return true;
			case '-': // Error reply
				throw new Exception('Redis error: '.$line);
			case ':': // Integer reply
				// no cast to int as it is in the range of a signed 64 bit integer
				return $line;
			case '$': // Bulk replies
				if($line=='-1')
					return null;
				$length=$line+2;
				$data='';
				while($length>0)
				{
					if(($block=fread($socket,$length))===false)
						throw new Exception('Failed reading data from redis connection socket.');
					$data.=$block;
					$length-=(function_exists('mb_strlen') ? mb_strlen($block,'8bit') : strlen($block));
				}
				return substr($data,0,-2);
			case '*': // Multi-bulk replies
				$count=(int)$line;
				$data=array();
				for($i=0;$i<$count;$i++)
					$data[]=parseResponse();
				return $data;
			default:
				throw new Exception('Unable to parse data received from redis.');
		}
	}