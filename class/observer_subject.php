<?php
class Reader implements SplObserver {
    private $name;
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function update(SplSubject $subject){
        echo $this->name.' is reading breakout news <b>'.$subject->getContent().'</b><br>';
    }
}

class Newspaper implements SplSubject {
    private $name ;
    private $observer = array() ;
    private $content ;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function attach(SplObserver $observer){
        $this->observer[] = $observer;
    }
    public function detach(SplObserver $observer){
        $key = array_search($observer,$this->observer,true);
        if($key){
            unset($this->observer[$key]);
        }
    }
    public function getContent() {
        return $this->content." ({$this->name})";
    }
    public function breakOutNews($content) {
        $this->content = $content;
        $this->notify();
    }
    
    public function notify(){
        foreach($this->observer as $item)
            $item->update($this);
    }
}
print_r(get_include_path());
$subject = new Newspaper("game giff add");
$leader = new Reader("Leader");
$manager = new Reader("manager");
$my = new Reader("my");

$subject->attach($leader);
$subject->attach($manager);
$subject->attach($my);
$subject->detach($my);
$subject->breakOutNews('USA break down!');



