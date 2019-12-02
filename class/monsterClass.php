<?php
require_once "commonClass.php";
use \Common\Creature;
use \Common\History;

//モンスタークラス
class Monster extends Creature
{
    //***プロパティ
    protected $img;

    //***コンストラクタ
    public function __construct($name, $hp, $img, $attackMin,$attackMax)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->attackMin = $attackMin;
        $this->attackMax = $attackMax;
    }

    public function getImg()
    {
        if (empty($this->img)) {
            return 'img/noimage.jpg';
        }
        return $this->img;
    }

    public function sayCry(){
        History::set($this->getName().'が叫ぶ')."\n";
        History::set('ぐはあ！')."\n";
    }    
}

//マジックモンスタークラス
class MagicMonster extends Monster
{
    private $magicAttack;
    public function __construct($name, $hp, $img, $attackMin, $attackMax,$magicAttack)
    {
        $this->magicAttack = $magicAttack;
        parent::__construct($name, $hp, $img, $attackMin,
        $attackMax);
    }

    public function getMagicAttack(){
        return $this->magicAttack;
    }

    public function attack($targetObj)
    {
        if (!mt_rand(0, 3)) {
            History::set($this->name . 'の魔法攻撃!'."\n");
            $magicAttackPoint = (int)$this->getMagicAttack();
            $targetObj->setHp($targetObj->getHp() - $this->magicAttack);
            History::set($this->magicAttack . 'ポイントのダメージを受けた！');
        } else {
            parent::attack($targetObj);
        }
    }
}

