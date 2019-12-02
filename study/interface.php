<?php

abstract class Ikimono{
    abstract public function hello();
    protected function hey(){
        echo 'hey'."\n";
    } 
}

interface Goodnight{
    public function sayGoodNight();
}

class Monster extends Ikimono implements Goodnight{
    public function hello(){
        echo 'hello';
    }
    public function call(){
    parent::hey();
    }
    
    function sayGoodNight(){
        echo 'goodnight'."\n";
    }
}

$monster = new Monster();
$monster->call();
$monster->sayGoodNight();

?>
