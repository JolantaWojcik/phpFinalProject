<?php
ini_set('display_errors', '1');

class Controller 
{
	public function model($model) 
	{
		require_once('../app/models/' . $model . '.php');
		return new $model();  //zwracamy obiekt modelu
	}
	
	public function view($view, $data = array()) 
	{
		require_once('../app/views/' . $view . '.php');
		if(!empty($data)) {
			return $data;
		};
	}
}