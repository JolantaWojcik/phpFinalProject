<?php
//model
class Movies {
	private $_data;
	private $_db;
	
	public function __construct() {
		$this->_db = DB::getInstance();
	}
	
	public function find($movie = null) {
		if($movie) {
			$field = (is_numeric($movie)) ? 'id' : 'title';
			$data = $this->_db->get('movie', array($field, '=', $movie));

			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	
	public function data() {
		return $this->_data;
	}
}