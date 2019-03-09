<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {

$app -> add(['Header','You have won 50 EUR! On which acc you want them to transfer them']);
$image = $app->add(['Image','https://www.stockworld.com.ua/media/cache/news/uploads/news/5bd0315e64d4979220008355/48d235ed.jpg']);

$m = $app->add('Menu');
$sm = $m->addMenu('Accounts');

$client = new Client($db);
$client -> load($_SESSION['id']);
$acc = $client->ref('Accounts');
$win = new Accounts($db);
//kto 4itaet tot loh
foreach ($acc as $shot) {
  $sm->addItem($shot['acc_num'])->on('click', function($action) use ($shot) {
  //  $win->loadBy('acc_num',$shot);
    $shot['money'] = $shot['money'] + 50;
    $shot -> save();
    return new \atk4\ui\jsExpression('document.location="main.php"');
  });
}
} else {
  Header('location:index.php');
}
