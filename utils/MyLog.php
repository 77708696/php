<?php
class MyLog{
    
    private $str='';
    const LOG_LEVEL_ERR = 0;
    const LOG_LEVEL_NOTICE = 1;
    const LOG_LEVEL_WARNING = 2;
    
    public function __construct(){
        
    }
    public function __destruct(){
        if($this->str!='')
        {
          $file = 'G:\\log' . date('Ymd') . '.txt';
          $handle = fopen($file,"a+");
          // var_dump(  file_put_contents($file, $this->str,FILE_APPEND) );
          fwrite($handle, $this->str);
          fclose($handle);
          
          error_log($this->str,3,'G:\\log11.txt');
           echo $file;
        }
    }
    
    public function log($str,$level)
    {
        switch ($level) {
            case self::LOG_LEVEL_ERR :
                $this->str .= 'ERR:' . $str;
                break;
            case self::LOG_LEVEL_NOTICE :
                $this->str .= 'NOTICE:' . $str;
                break;
            case self::LOG_LEVEL_WARNING :
                $this->str .= 'WARNING:' . $str;
                break;
        }
    }
    
    public function err($str){
        $this->log(date('Y-m-d H:i:s') . ":" .$str . "\r\n", self::LOG_LEVEL_ERR);
    }
    
}

$mylog = new MyLog();

$mylog->err("err01");

var_dump(debug_backtrace());



