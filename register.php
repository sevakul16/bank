<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Debts');
$app->initLayout('Centered');

$client = new Client($db);
$form = $app ->layout ->add('Form');
$form -> setModel(new Client($db));
$form -> onSubmit(function($form) {
  $form->model->save();
  return new \atk4\ui\jsExpression('document.location="index.php"');
});
