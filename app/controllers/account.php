<?php
//controller
ini_set('display_errors', '1');
require_once('../app/core/Controller.php');

class Account extends Controller 
{
	public function index($name = '') 
	{

	if(Session::exists('home')) {
		echo '<p>'.Session::flash('home'). '</p>';
	}
	
	$this->view('account');
	}
}
