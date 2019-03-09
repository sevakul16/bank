<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {

$image = $app->add(['Image','https://fortunedotcom.files.wordpress.com/2017/04/gettyimages-157418272.jpg']);

$client = new Client($db);
$accounts = new Accounts($db);
$currency = new Currency($db);

$grid_cl = $app->add('CRUD');
$grid_cl->setModel($client);

$grid_acc = $app->add('CRUD');
$grid_acc->setModel($accounts);

$grid_cl = $app->add('CRUD');
$grid_cl->setModel($currency);
} else {
  Header('location:index.php');
}
