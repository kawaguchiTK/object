<?php
namespace Common;

//生き物（抽象）クラス
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
    public function attack($targetObj){
        $attackPoint = mt_rand($this->attackMin,$this->attackMax);
        //10分の１の確率でクリティカルヒット
        if(mt_rand(0,2) == NULL){
        $attackPoint = $attackPoint * 1.5;
        $attackPoint = (int)$attackPoint;
        History::set($this->getName().'のクリティカルヒット!');
        }
        $targetObj->setHp($targetObj->getHp() - $attackPoint);
        History::set($attackPoint.'のダメージ！');
    }
}

//historyクラス(インターフェイス)
interface HistoryInterface{
    public static function set($str);
    public static function clear();
}

//historyクラス
class History implements HistoryInterface
{
    public static function set($str)
    {
        if (empty($_SESSION['history'])) {
            $_SESSION['history'] = '';
        }
        $_SESSION['history'] .= $str . '<br>';
    }
    public static function clear()
    {
        unset($_SESSION['history']);
    }
}