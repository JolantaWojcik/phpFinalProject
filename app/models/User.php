<?php
//model
class User {
	private $_db;
	private $_data;
	private $_sessionName;
	private $_cookieName;
	private $_isLoggedIn;
	
	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		
		$this->_sessionName = Config::get('session/session_name');  //user
		$this->_cookieName = Config::get('remember/cookie_name');   //hash
	
		if(!$user) {
			if(Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);  //$user zwraca id

					if($this->find($user)) {
						$this->_isLoggedIn = true;
					} else {
						//Logout
					}
			}
			
		} else {
			$this->find($user);
		}
	}
	
	public function update($fields = array(), $id = null) {
		
		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->id;
		}
		
		if(!$this->_db->update('uzytkownicy', $id, $fields)) {
			throw new Exception('Mamy problem z bazą danych');
		}
	}
	
	public function create($fields = array()) {
		if(!$this->_db->insert('uzytkownicy', $fields)) {
			throw new Exception('Mamy pewien problem z utworzeniem Twojego konta!');
		}
	}
	
	public function find($user = null) {
		if($user) {
			$field = (is_numeric($user)) ? 'id' : 'login';
			$data = $this->_db->get('uzytkownicy', array($field, '=', $user)); //data to nie wynik select, ale cały zwrócony 
			//obiekt $this, czyli obiekt DB
			
			if($data->count()) {
				$this->_data = $data->first();  //$this->_data to wszystkie dane uzytkownika
				return true;
			}
		}
		return false;
	} //ostatecznie to sprawia, że w $this->_data jest cały user
		
	public function login($login = null, $haslo = null, $remember = false) {
		
		if(!$login && !$haslo && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {
			$user = $this->find($login);  //user to true
		
		if($user) {
			if($this->data()->haslo === Hash::make($haslo, $this->data()->salt)) { //sprawdzanie hasla
				Session::put($this->_sessionName, $this->data()->id);
				
				if($remember) {
					$hash = Hash::unique();

					$hashCheck = $this->_db->get('sesje', array('uzytkownicy_id', '=', $this->data()->id));  //POPSUTE
					//sprawdzam czy w sesjach jest ktos z id pauliny

					if(!$hashCheck->count()) {
						$hashCheck = $this->_db->insert('sesje', array(
							'uzytkownicy_id' => $this->data()->id,
							'hash' => $hash
						));
					} else {
						$hash = $hashCheck->first()->hash;
					}
					
					Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
				}
				return true;
			}
		}
	}
	return false;
	}
	
	public function exists() {
		return(!empty($this->_data)) ? true : false;
	}
	
	public function logout() {
		echo $this->data()->id;
		if($this->_db->delete('sesje', array('uzytkownicy_id', '=', $this->data()->id))) {
			echo "usunieto";
		}
	
		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}
	
	public function data() {
		return $this->_data;
	}
	
	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}
	
}