<?php

class Painel_LoginController extends Zend_Controller_Action {

	public function indexAction() {
		$form = new Application_Painel_Form_Login();
		
		if ($this->getRequest()->isPost() and $form->isValid($this->getRequest()->getPost())) {
			// recebendo valores do formulário
			$valores = $form->getValues();

			// criando o adaptador
			$adaptador = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
			
			// setando a tabela
			$adaptador->setTableName("usuario");
			
			// setando a coluna que será o identificador
			$adaptador->setIdentityColumn("email");
			
			// setando a coluna que será a senha
			$adaptador->setCredentialColumn("senha");
			
			// setando o identificador digitado pelo usuário
			$adaptador->setIdentity($valores["email"]);
			
			// setando a senha digitada pelo usuário
			$adaptador->setCredential($valores["senha"]);
			
			// setando o tratamento para valor de senha
			$adaptador->setCredentialTreatment("MD5(?) AND ativo = 1");
			
			// recuperando a insctância de autenticação
			$auth = Zend_Auth::getInstance();
			
			// setando o adaptador na instância
			$resultado = $auth->authenticate($adaptador);
			

			// validando a autenticação
			if ($resultado->isValid()) {
				// se a validação for OK, retornar objeto da linha válida (linha da tabela)
				$dados = $adaptador->getResultRowObject(NULL, array("senha"));

				// escreve na sessão os dados
				$auth->getStorage()->write($dados);
				
				$this->_helper->redirector("ver", "imagem", "default");
			} else {
				$this->_helper->flashMessenger->addMessage(array('failure'=>'Problema com Usuário e Senha'));
				$this->_helper->redirector("index", "login", NULL);
			}
		}
		
		$this->view->form = $form;
	}
	
	public function logoutAction(){
		// instancia a autenticação
		$auth = Zend_Auth::getInstance();
		
		// limpa os dados salvos em storage
		$auth->clearIdentity();

		// redireciona
		$this->_helper->redirector("index", "index", "default");
	}
}

