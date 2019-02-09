<?php
session_start();
require 'vendor/autoload.php';
require 'Models.php';
$app = new \atk4\ui\App ('BANK OF MEMES');
$app->initLayout('Centered');

$Header = $app ->add(['Header','Bank of Memes','red']);
$image = $app->add(['Image','https://scontent-arn2-1.xx.fbcdn.net/v/t31.0-8/fr/cp0/e15/q65/21994486_1805986493026137_8985008925666498685_o.jpg']);

$user = new Client($db);
$log = $app ->layout -> add('Form');
$log -> setModel(new Client($db),['login','password']);
$log ->buttonSave -> set('Penetrate');
$log -> onSubmit(function($log) use ($user){
  if (($log->model['login']=='admin') and ($log->model['password']=='admin')) {
      return new \atk4\ui\jsExpression('document.location="admin.php"');
  }
  $user -> TryLoadBy('login',$log->model['login']);
  if ($user['password'] == $log ->model['password']){
    $_SESSION['id'] = $user->id;
    return new \atk4\ui\jsExpression('document.location="main.php"');
  } else {
    $user ->unload();
    $er = (new \atk4\ui\jsNotify('Wrong login or password'));
    $er -> setColor('black');
    return $er;
  }
});

$button = $app -> add(['Button','Register a profile']);
$button -> link(['register']);
unset($_SESSION['timer']);
unset($_SESSION['t']);
unset($_SESSION['flag']);
