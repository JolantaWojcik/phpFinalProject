<?php
//controller
require_once('../app/core/Controller.php');

class Review extends Controller 
{
	public function index($name = '') 
	{
		$this->view('review');
	}
}