<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }
    
    public function scheduleeventAction() {
        $scheduleeventform = new Application_Form_Scheduleeventform();
        $this->view->form = $scheduleeventform;
        if ($this->getRequest()->isPost()) {
            $inputdata = $this->getRequest()->getPost();
            
        }
    }

    public function getformAction() {
        $myform = new Application_Form_Dataform();
        $myform->setAttrib('onsubmit', 'return doCheckDates();');
        $this->view->form = $myform;
        if ($this->getRequest()->isPost()) { /* post action */
            $inputdata = $this->getRequest()->getPost();
            if ($myform->isValid($inputdata)) { /* valid data */
                $title = $myform->getValue('title');
                $color = $myform->getValue('color');
                $date1 = $myform->getValue('date1');
                $date2 = $myform->getValue('date2');
                $email = $myform->getValue('email');
                $url = $myform->getValue('url');
                $range = $myform->getValue('range');
                $numb = $myform->getValue('numb');

                $report = array(
                    'title' => $title,
                    'color' => $color,
                    'date1' => $date1,
                    'date2' => $date2,
                    'email' => $email,
                    'url' => $url,
                    'range' => $range,
                    'numb' => $numb
                );
                $this->view->report = $report;
            } else { /* bad data */
                $myform->populate($inputdata);
                /* Basically, filling in data that were ok and
                 * then redisplaying form 
                 */
            }
        }
        /* The corresponding .phtml file will be called */
        /* If $report has been set in post action it will display 
         * the data submitted, else just shows the form 
         */
    }

    public function anotherAction() {
        
    }

    private function checkcredentials($formData) {
        $authAdapter = new Zend_Auth_Adapter_DbTable(); // use default db adapter
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
            $this->_redirect('/'); // send them back to index page
        } else {
            // Let them try to login again
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
