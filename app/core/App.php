<?php
ini_set('display_errors', '1');

class App 
{
	protected $controller = 'home';   //domyślnie jest kontroler home, construct może go zmienić
	protected $method = 'index';
	protected $params = array(); //[] dla php >5.4
	public function __construct() 
	{
		$url = $this->parseUrl();
		
		//jeśli będzie coś innego poza istniejącymi kontrolerami, wywoła home
		if(file_exists('../app/controllers/' . $url[0] . '.php'))   //nie zapominać, że wywołujemy z directory /public/index.php
		{
			$this->controller = $url[0];
			unset($url[0]);
		}
		
		require_once('../app/controllers/' . $this->controller . '.php');
		
		$this->controller = new $this->controller;   
		
		if(isset($url[1])) 
		{
			if(method_exists($this->controller, $url[1])) {
				$this->method = $url[1];

				unset($url[1]);   //robimy unset, żeby mieć tablicę tylko z elementów 
			}
		}

		$this->params = $url ? array_values($url) : array();  //$this->params to teraz tablica z parametrami
		call_user_func_array(array($this->controller, $this->method), $this->params);
	}
	
	
	public function parseUrl() 
	{
		if(isset($_GET['url'])) {
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));  
		} //dzieki temu mamy wszystko oddzielone ładnie w tablicy
	}
	
}