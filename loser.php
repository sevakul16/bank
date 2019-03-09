<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {

unset($_SESSION['i']);
unset($_SESSION['flag']);
unset($_SESSION['timer']);
unset($_SESSION['t']);

$app -> add(['Header','You have lost!']);
$button = $app -> add(['Button','Try again']);

$button -> link('game.php');
} else {
  Header('location:index.php');
}
