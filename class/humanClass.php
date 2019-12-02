<?php
require_once "commonClass.php";
use \Common\Creature;
use \Common\History;

//性別クラス
class Sex
{
    const MAN = 1;
    const WOMAN = 2;
}

//人間クラス
class Human extends Creature
{
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
    public function getSex(){
        return $this->sex;
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
