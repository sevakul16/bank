<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('Bank');
$app->initLayout('Centered');

if (isset($_SESSION['id'])==true) {

$form = $app ->layout ->add('Form');
$form -> setModel(new Client($db));
$form -> onSubmit(function($form) {
  $form->model->save();
  return new \atk4\ui\jsExpression('document.location="index.php"');
});
} else {
  Header('location:index.php');
}
