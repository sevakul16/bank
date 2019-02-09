<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

$client = new Client($db);
$client -> load($_SESSION['id']);

$form = $app ->layout -> add(['Form']);
$form -> addField('Sender');
$form -> addField('Reciever');
$form -> addField('Sum');
$form -> onSubmit(function($form) use($db) {
  $acc1 = new Accounts($db);
  $acc2 = new Accounts($db);
  if ($form -> model['Sum'] <= 0) {
    throw new \atk4\data\ValidationException(['Sum'=>"Field sum can not be negative or 0"]);
  };
  $acc1->addHook('afterLoad', function($acc1) use ($form) {
      if ($acc1['money'] < $form ->model['Sum']) {
        throw new \atk4\data\ValidationException(['Sum'=>"You don't have enough money"]);
      } else {
        return 1;
      }
  });
  $acc1->loadBy('acc_num',$form->model['Sender']);
  $acc2->loadBy('acc_num',$form->model['Reciever']);

  $acc1['money'] = $acc1['money'] - $form ->model['Sum'];
  $acc2['money'] = $acc2['money'] + $form ->model['Sum'];
  $acc1 -> save();
  $acc2 -> save();
  return new \atk4\ui\jsExpression('document.location="main.php"');
});
