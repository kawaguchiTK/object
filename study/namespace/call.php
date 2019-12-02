<?php
require_once 'sato.php';
require_once 'suzuki.php';

use Woman\Suzuki; //※推奨　先に名前空間を宣言

$suzuki = new Suzuki();
$sato = new \Man\Sato(); //名前空間のフルパスを記述

echo $suzuki->sayHello();

echo "<br>";

echo $sato->sayHello();
?>
