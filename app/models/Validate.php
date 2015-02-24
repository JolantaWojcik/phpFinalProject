<?php
class Validate {
	private $_passed = false, 
			$_errors = array(),
			$_db = null;
			
	public function __construct() {
		if($this->_db = DB::getInstance()) {
		};
	}
	
	public function check($source, $items = array()) {
		//print_r($source);
		foreach($items as $item => $rules) {
			foreach($rules as $rule => $rule_value) {
				$value = trim($source[$item]);				
				$item = escape($item);						
				
				if($rule === 'required' && empty($value)) {
					$this->addError("musisz wypełnić pole {$item}");
				} else if(!empty($value)) {
					switch($rule) {
						case 'min':
							if(strlen($value) < $rule_value) {
								$this->addError("{$item} musi mieć minimum {$rule_value} znaków.");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value) {
								$this->addError("{$item} musi mieć minimum {$rule_value} znaków.");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value]) {  
								$this->addError("{$rule_value} musi być identyczne do {$item}");
							}
						break;
						case 'unique':  
							if($check = $this->_db->get($rule_value, array($item, '=', $value))) { 
							}
							if($check->count()) { 
								$this->addError("{$item} już istnieje");
							}
						break;
					}
				}
			}
		}
		if(empty($this->_errors)) {
			$this->_passed = true;
		}
	}

	private function addError($error) {
		$this->_errors[] = $error; 
	}
	
	public function errors() {
		return $this->_errors;
	}
	
	public function passed() {
		return $this->_passed;
	}
}



?>	