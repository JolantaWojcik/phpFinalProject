<?php
//controller
class Movie extends Controller {
	private $_data;
	
	public function index() {
		$this->view('movie');
	}
}