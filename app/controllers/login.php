<?php
require_once('../app/core/Controller.php');

class Login extends Controller {
	
	public function index() {
	if(Input::exists()) {
		if(Token::check(Input::get('token'))) {
			
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'login' => array('required' => true),
				'haslo' => array('required' => true),
			));
			
			if($validate->passed()) {   //dane ok
				$user = new User();		//tworzenie nowego u¿ytkownika user
				
				$remember = (Input::get('remember') === 'on') ? true : false;   //remember true or not if checked
				$login = $user->login(Input::get('login'), Input::get('haslo'), $remember); //jeœli walidacja ok, zaloguj
				
				if($login) {
					Redirect::to('index.php');
				} else {
					echo "Poda³eœ nieprawid³owe dane!";
				}
			} else {
				foreach($validate->errors() as $error) {
					echo $error, "<br>";
				}
			}
		}
	}
	$this->view('login');
	}
}

?>