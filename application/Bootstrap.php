<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initDoctype() {
		$this->bootstrap ( 'view' );
		$view = $this->getResource ( 'view' );
		$view->doctype ( 'XHTML1_STRICT' );
	}
	protected function _initResourceLoader() {
		$this->_resourceLoader->addResourceType ( 'form', 'modules/default/forms', 'Form' );
		$this->_resourceLoader->addResourceType ( 'form_painel', 'modules/painel/forms', 'Painel_Form' );
	}
}

