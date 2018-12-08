<?php
require 'vendor/autoload.php';
$db = new \atk4\data\Persistence_SQL('mysql:dbname=bank;host=localhost','sexking','lehaloh');

Class Client extends \atk4\data\Model {
  public $table ='client';
  Function init() {
    parent::init();
    $this -> addField('login');
    $this -> addField('password',['type'=>'password']);
    $this -> addField('name');
    $this -> addField('surname');
    $this -> addField('pers_code');
    $this -> hasMany('Accounts',new Accounts);
  }
}

Class Accounts extends \atk4\data\Model {
  public $table ='accounts';
  Function init() {
    parent::init();
    $this -> addField('acc_num');
    $this -> addField('money');
    $this -> hasOne('client_id',new Client);
  }
}
