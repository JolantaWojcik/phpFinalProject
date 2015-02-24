<?php
//controller
ini_set('display_errors', '1');
require_once('../app/core/Controller.php');

class Order extends Controller 
{
	public function index($name = '') 
	{
	
	$this->view('order');
	}
}
