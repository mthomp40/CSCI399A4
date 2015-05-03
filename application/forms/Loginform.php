<?php

class Application_Form_Loginform extends Zend_Form {

    public function init() {
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('User name:')
                ->setAttrib('size', 10)
                ->setAttrib('maxlength', 10)
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                ->setAttrib('size', 10)
                ->setAttrib('maxlength', 10)
                ->setRequired(true)
                ->addFilter('Alnum');
        $submit = $this->createElement('submit', 'submit');
        $submit->setLabel("Login");
        $this->addElements(array($username, $password, $submit));
    }

}
