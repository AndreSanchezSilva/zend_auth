<?php

class ImagemController extends Zend_Controller_Action {
	
	public function init(){
		$this->validar();
	}
	
	public function verAction() {
	}
	
	public function testeAction(){
		echo 1234;
		exit;
	}
	
	public function novotesteAction(){
		echo 1234;
		exit;
	}
	
	public function validar(){
		$this->auth = Zend_Auth::getInstance();
		$this->usuario = $this->auth->getIdentity();

		if (! $this->auth->hasIdentity()) {
			$this->_helper->redirector("index", "login", "painel");
		}
	}
	
}

