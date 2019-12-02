<?php


abstract class Creature{
    
    protected $name;
    protected $hp;
    protected $attackMin;
    protected $attackMax;

    abstract public function sayCry();
    public function setName($str){
        $this->name = $str;
    }
    public function getName(){
        return $this->name;
    }
    public function setHp($num){
        $this->hp = $num;
    }
    public function getHp(){
        return $this->hp;
    }
}


class Human extends Creature{
    protected $sex;
    public function __construct($name,$sex,$hp,$attackMin,$attackMax){
        $this->name = $name;
        $this->sex = $sex;
        $this->hp = $hp;
        $this->attackMin = $attackMin;
        $this->attackMax = $attackMax;
    }
    public function setSex($str){
        $this->sex = $str;
    }
    public function sayCry(){
        History::set($this->name.'が叫ぶ');
        switch($this->sex){
            case SEX::MAN :
             History::set('ぐはあ！');
             break;
            case SEX::WOMAN :
             History::set('ぎゃ!');
             break;
        }
    }

} 

class Sex{
    const MAN = 1;
    const WOMAN = 2;
}

//$name,$sex,$hp,$attackMin,$attackMax
$human = new Human('勇者',SEX::MAN,5000,20,40);

$human->setName('洋');
echo $human->getName();