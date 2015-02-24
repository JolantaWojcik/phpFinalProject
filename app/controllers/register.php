<?php
require_once('../app/core/Controller.php');

class Register extends Controller {
	public function index() {
		if(Input::exists()) {
			if(Token::check(Input::get('token'))) {
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'login' => array(
						'required' => true,
						'min' => 2,
						'max' => 20,
						'unique' => 'uzytkownicy',
						'pole' => 'pole2'
					),
					'haslo' => array(
						'required' => true,
						'min' => 6,
					),
					'powtorz_haslo' =>array(
						'required' => true,
						'matches' => 'haslo',
					),
					'imie' => array(
						'required' => true,
						'min' => 2,
						'max' => 50,
					)
				));

				
				if($validate->passed()) {
					$user = new User();
					
					$salt = Hash::salt(32);
					
						try {
						$user->create(array(
							'login' => Input::get('login'),
							'haslo' => Hash::make(Input::get('haslo'), $salt),
							'salt' => $salt,
							'imie' => Input::get('imie'),
							'data_utworzenia' => date('Y-m-d H:i:s'),
							'grupa_id' => 1
						));
						
						Session::flash('home','Zostałeś zarejestrowany!');
						Redirect::to('index.php');  
							
						} catch(Exception $e) {
							die($e->getMessage());
						}
				} else {
					$this->view('validatenotpassed', $validate->errors());
					return true;
				}
			}
		}
	$this->view('register');
	}
}
?>











