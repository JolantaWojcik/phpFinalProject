<?php
//controller
class Movielist extends Controller {
	private $_data;
	
	public function index() {
		$this->view('movielist');
	}
}