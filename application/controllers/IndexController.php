<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    private function checkcredentials($formData) {
        $authAdapter = new Zend_Auth_Adapter_DbTable();
        $authAdapter->setTableName('ecuserroles')
                ->setIdentityColumn('username')
                ->setCredentialColumn('pwd');
        $authAdapter->setIdentity($formData['username']);
        $authAdapter->setCredential($formData['password']);
        $authenticator = Zend_Auth::getInstance();
        $check = $authenticator->authenticate($authAdapter);
        if ($check->isValid()) {
            $matchrow = $authAdapter->getResultRowObject(null, 'password');
            $authenticator->getStorage()->write($matchrow);
            $this->_redirect('/');
        } else {
            $this->_redirect('/index/login');
        }
    }

    public function loginAction() {
        $loginform = new Application_Form_Loginform();
        $this->view->form = $loginform;
        if ($this->getRequest()->isPost()) {
            $inputdata = $this->getRequest()->getPost();
            $this->checkcredentials($inputdata);
        }
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/');
    }

}
