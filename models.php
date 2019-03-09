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
    $this -> addField('currency');
    $this -> addField('money');
    /*if ($this['currency']=='USD') {
      $this -> addField('money',['type'=>'money','prefix'=>'$']);
    }
    if ($this['currency']=='RUR') {
      $this -> addField('money',['type'=>'money','prefix'=>'₽']);
    } else {
      $this -> addField('money',['type'=>'money','prefix'=>'F']);
    }  */
    $this -> hasOne('client_id',new Client);
  }
}

Class Currency extends \atk4\data\Model {
  public $table ='currency';
  Function init() {
    parent::init();
    $this ->addField('name');
    $this ->addField('coeff');
  }
}
