<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {

$client = new Client($db);
$client -> load($_SESSION['id']);
$acc = $client->ref('Accounts');
unset($_SESSION['i']);
unset($_SESSION['flag']);
unset($_SESSION['timer']);
unset($_SESSION['t']);

$grid = $app -> add('Grid');
$grid -> setModel($acc,['acc_num','money','currency']);

$button = $app -> add(['Button','Add an account for FREE!!!11!!']);
$button -> link(['register_acc']);
$button2 = $app -> add(['Button','Transact your money']);
$button2 -> link(['perevod']);
$button3 = $app -> add(['Button','Minigame!']);
$button3 -> link(['game']);

} else {
  Header('location:index.php');
}
