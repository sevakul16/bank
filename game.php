<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {

$now = time();

if (!isset($_SESSION['flag'])){
  $_SESSION['timer'] = time();
}

$_SESSION['t'] = $now -$_SESSION['timer'];

 $button = $app ->add(['Button','Touch me','big red']);

 $button -> on('click', function($action){
   if (($_SESSION['t'] <= 10) and ($_SESSION['i'] >= 10)) {
    return new \atk4\ui\jsExpression('document.location="prize.php"');
   }
   if ($_SESSION['t'] > 10) {
      return new \atk4\ui\jsExpression('document.location="loser.php"');
   }
   $_SESSION['i']=$_SESSION['i']+1;
   $_SESSION['flag'] = true;
   return $action->text($_SESSION['i']);

 });
} else {
  Header('location:index.php');
}
/*
 $button2 = $app->add('Button');

 $button2->on('click', function ($action){
   $_SESSION['flag'] = true;
   return $action ->text($_SESSION['t']);
 });*/
