<?php
//model
class Actor {
	private $_data;
	private $_actordata; //tablica z obiektami z tabeli movie_aktorzy
	private $_actorlist;
	private $_db;
	
	public function __construct() {
		$this->_db = DB::getInstance();
	}
	
	public function findactor($actor = null) {
		if($actor) {
			$data = $this->_db->get('aktorzy', array('id', '=', $actor));

			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	
	public function findactorbyfilm($movieid = null) {   //podajemy id filmu
		if($movieid) {   //jeœli podaliœmy...
			$actordata = $this->_db->get('movie_aktorzy', array('movie_id', '=', $movieid)); //...to wydobywamy dane z intersection table dla tego id filmu
			
			if($actordata->count()) {  //jeœli w tabeli coœ jest
				$this->_actordata = $actordata->results(); //to przypisujemy te dane do zmiennej $_actordata
			}
			
			$actorlist = array(); //tworzymy pust¹ tablicê i bêdziemy j¹ po kolei wype³niaæ nazwiskami
			
			foreach($this->actordata() as $key => $value) {
				$data = $this->_db->get('aktorzy', array('id', '=', $value->aktorzy_id));
				
				if($data->count()) {
					array_push($actorlist,$data->first());
				}
			}
			$this->_actorlist = $actorlist;
		}
		return false;
	}
	
	public function actordata() {
		return $this->_actordata;
	}
	
	public function data() {
		return $this->_data;
	}
	
	public function actorlist() {
		return $this->_actorlist;
	}
}