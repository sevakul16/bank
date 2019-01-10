<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

$image = $app->add(['Image','https://fortunedotcom.files.wordpress.com/2017/04/gettyimages-157418272.jpg']);

$client = new Client($db);
$accounts = new Accounts($db);

$grid_cl = $app->add('CRUD');
$grid_cl->setModel($client);

$grid_acc = $app->add('CRUD');
$grid_acc->setModel($accounts);
