<?php
session_start();
require_once 'core/App.php';
require_once 'core/Controller.php';



$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost' ,
		'username' => '' ,
		'password' => '' ,
		'db' => '' ,
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => '604800',
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token',
	),
);

//stworzyc wiecej autoloaderow
spl_autoload_register(function($class) {
		require_once 'models/'.$class.'.php';  
	}
);


require_once 'functions/sanitize.php';  

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('sesje', array('hash', '=', $hash));

	if($hashCheck->count()) {
		$user = new User($hashCheck->first()->uzytkownicy_id);
		$user->login();
	}
};




