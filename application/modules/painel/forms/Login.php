<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutomovelForm
 *
 * @author Alunos
 */
class Application_Painel_Form_Login extends Zend_Form {

	public function init() {
		$email = new Zend_Form_Element_Text('email');
		$email->setRequired();
		$email->setLabel("Email");

		$senha = new Zend_Form_Element_Password('senha');
		$senha->setRequired();
		$senha->setLabel("Senha");

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel("Enviar");
		
		// Adicionando Elementos
		$elementos = array($email, $senha, $submit);
		$this->addElements($elementos);
	}
}

?>
