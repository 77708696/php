<?php
trait wordwrap{
    
    private static $instance;
    public static $name = '111111111';
    public static function Word()
    {
        return __TRAIT__ . self::$name;
    }
    
    
    
}

class Hello {
        use wordwrap;
        public function text( $str )
        {
            return $this->tmp.$str;
        }
    }
echo Hello::Word();
echo Hello::$name;