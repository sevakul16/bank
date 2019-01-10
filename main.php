<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

$client = new Client($db);
$client -> load($_SESSION['id']);
$acc = $client->ref('Accounts');

$grid = $app -> add('Grid');
$grid -> setModel($acc,['acc_num','money','currency']);

$button = $app -> add(['Button','Add an account for FREE!!!11!!']);
$button -> link(['register_acc']);
