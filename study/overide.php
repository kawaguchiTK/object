<?php
class Monster
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function attack()
    {
        echo $this->name . 'の攻撃!!';
    }
}

class MagicMonster extends Monster
{
    protected $magicName;

    public function __construct($name, $magicName)
    {
        //親クラスのメソッドを実行
        parent::__construct($name);
        $this->magicName = $magicName;
    }

    public function sayNameAndMagic()
    {
        //親クラスのプロパティを参照
        echo $this->name . 'の' . $this->magicName;
    }

    //オーバーライド(親メソッドの上書き)
    public function attack()
    {
        if (mt_rand(0, 2) == null) {
            echo '【魔法攻撃】 ' . $this->name . 'の' . $this->magicName;
        } else {
            parent::attack();
        }
    }

}

//実行部分
$monster = new Monster('スカル');
$magicMonster = new MagicMonster('マジックスカル', '火炎放射');

// $monster->attack();
// $magicMonster->sayNameAndMagic();
$magicMonster->attack();
