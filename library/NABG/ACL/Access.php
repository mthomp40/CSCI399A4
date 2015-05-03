<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NABG_ACL_Access
 *
 * @author nabg
 */
class NABG_ACL_Access {

    public $acl;

    public function __construct() {
        // Here define all the roles, resources, and priveleges and
        // store them in a Zend_ACL object
        $this->acl = new Zend_Acl();
        // My roles - guest, and 'me'
        // A guest can do most things, 'me' can access the extra function
        $this->acl->addRole('guest', null);
        $this->acl->addRole('privileged', 'guest');


        // My resources - well really they are the controllers -

        $this->acl->addResource("index");
        $this->acl->addResource("error");
        $this->acl->addResource("data");

        // Zend_Acl is supposed to start off with an effective "Deny from All"
        // So add some allowed combinations of actions

        // guest can use all actions of index controller except logout
        $this->acl->allow('guest', 'index', array('index', 'login', 'getform', 'another'));
        // guest can use all actions on error controller
        $this->acl->allow('guest', 'error');
        
        // guest can use the doa method on data controller
        $this->acl->allow('guest','data', array('doA'));
      
        // privileged can use logout on index controller and dob on data
        $this->acl->allow('privileged', 'index', array('logout'));
        $this->acl->allow('privileged', 'data', array('doB'));


    }

}

?>
