<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {


$form = $app ->layout ->add('Form');
$form -> setModel(new Accounts($db),['currency']);
$form -> onSubmit(function($form) {
  $str = ('LV42SEVA');
  for ($i = 1;$i <= 13;$i++) {
    $str = $str.rand(0,9);
  }
  $form->model['acc_num'] = $str;
  $form->model['money'] = 0;
  $form->model['client_id'] = $_SESSION['id'];
  $form->model->save();
  return new \atk4\ui\jsExpression('document.location="main.php"');
});
} else {
  Header('location:index.php');
}
