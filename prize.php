<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

$app -> add('Header','You have won 50 EUR! On which acc you want them to transfer them?');

$form = $app -> layout ->add('Form');
$form -> addField('acc_num');
//tut mozhno vibrat shot!
