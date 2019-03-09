<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {

$client = new Client($db);
$client -> load($_SESSION['id']);

$i=1;

$sen=$client->ref('Accounts');
foreach ($sen as $s) {
   $a[] = $s['acc_num'];
}
//var_dump($sen);
/*
foreach($sen as $csen) {
  $csen->load();
  $tesult[]=
}*/

$m=new \atk4\data\Model();
$m-> addField('Sender',['enum'=>$a]);
$m -> addField('Reciever');
$m -> addField('Sum');
$form = $app ->layout -> add(['Form']);
$form->setModel($m);
$form -> onSubmit(function($form) use($db) {
  $acc1 = new Accounts($db);
  $acc2 = new Accounts($db);
  $cur = new Currency($db);
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
  if ($acc1['currency'] <> $acc2['currency']) {
    $tmp = $form ->model['Sum'];
    $cur->loadBy('name',$acc1['currency']);
    $tmp = $tmp/$cur['coeff'];
    $cur->loadBy('name',$acc2['currency']);
    $acc2['money'] = $acc2['money'] + ($tmp * $cur['coeff']);
  } else {
    $acc2['money'] = $acc2['money'] + $form ->model['Sum'];
  };

  $acc1 -> save();
  $acc2 -> save();
  return new \atk4\ui\jsExpression('document.location="main.php"');
});
} else {
  Header('location:index.php');
}
