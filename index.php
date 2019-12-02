<?php
require_once "class/commonClass.php";
require_once "class/humanClass.php";
require_once "class/monsterClass.php";
use \Common\History;

ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');
session_start();

//インスタンス作成
$human[] = new Human('勇者見習い',Sex::MAN,10000,50,200);
$monsters[] = new Monster('フランケン', 100, 'img/monster01.png', 50,100);
$monsters[] = new Monster('ドラキュラ', 400, 'img/monster03.png', 70,100);
$monsters[] = new Monster('ドクロー', 150, 'img/monster05.png', 100,120);
$monsters[] = new Monster('ハンド', 600, 'img/monster07.png', 155,190);
$monsters[] = new MagicMonster('マジックモンスター', 500, 'img/dorogon.jpg', 50, 100,200);

function createHuman(){
    global $human;
    $_SESSION['human'] = $human[0];
}

function createMonster()
{
    global $monsters;
    $monster = $monsters[mt_rand(0, 4)];
    History::set($monster->getName() . 'が現れた!!');
    $_SESSION['monster'] = $monster;
}

function init()
{
    History::clear();
    History::set('初期化します');
    createMonster();
    createHuman();
    $_SESSION['knokdownCount'] = 0;
}

function gameOver()
{
    $_SESSION = array();
}

if (!empty($_POST)) {
    //どのボタンが押されたか判別
    $startFlg = (!empty($_POST['start'])) ? true : false;
    $attackFlg = (!empty($_POST['attack'])) ? true : false;
    $escapeFlg = (!empty($_POST['escape'])) ? true : false;

    //1.ゲームスタートの場合
    if ($startFlg) {
        History::set('ゲームスタート!');
        init();
    }

    //2.攻撃ボタンの場合
    if ($attackFlg) {
        
        //勇者の攻撃
        $_SESSION['human']->attack($_SESSION['monster']);
        
        //モンスターの叫び
        $_SESSION['monster']->sayCry();

        //モンスターの攻撃
        $_SESSION['monster']->attack($_SESSION['human']);
        //勇者の叫び
        $_SESSION['human']->sayCry();



        //自分のhpが0以下になったらゲームオーバー
        if ($_SESSION['human']->getHp() <= 0) {
            gameOver();
        } else {
            if ($_SESSION['monster']->getHp() <= 0) {
                History::set($_SESSION['monster']->getName() . 'を倒した!');
                createMonster();
                $_SESSION['knokdownCount']++;
            }
        }
    }
    //3.逃げた場合
    if ($escapeFlg) {
        History::set('逃げた！');
        createMonster();
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>objext</title>
</head>
<body>

  <div class="wrapper">
    <?php if (empty($_SESSION)) {?>
    <!-- ゲームスタート画面 -->
    <div class="start clearfix">
      <h2>GAME START?</h2>
      <form method="POST">
        <input type="submit" name="start" value="▶ゲームスタート">
      </form>
    </div>

    <?php } else {?>

    <!-- ゲーム画面 -->
    <div class="game">
      <h2><?php echo $_SESSION['monster']->getName() ?>が現れた!!!</h2>
      <img src="<?php echo $_SESSION['monster']->getImg() ?>" alt="" class="img">
      <p class="monster-hp">モンスターのHP:<?php echo $_SESSION['monster']->getHp(); ?></p>
      <p>倒したモンスターの数:<?php echo $_SESSION['knokdownCount']; ?></p>
      <p>勇者の残りHP:<?php echo $_SESSION['human']->getHp(); ?></p>
      <form method="POST">
        <input type="submit" value="▶攻撃する" name="attack">
        <input type="submit" value="▶逃げる" name="escape">
        <input type="submit" value="▶リスタート" name="start">
      </form>
    </div>

        <!-- インフォーメーション -->
    <div class="info">
      <?php if (!empty($_SESSION['history'])) {echo $_SESSION['history'];}?>

    </div>
    <?php }?>
  </div>

</body>
</html>
