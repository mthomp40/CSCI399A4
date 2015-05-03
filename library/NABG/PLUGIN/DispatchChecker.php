<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DispatchChecker
 *
 * @author nabg
 */
class NABG_PLUGIN_DispatchChecker extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $rightschecker = Zend_Registry::get('myaccessrights');
        $role = "guest";
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $role = Zend_Auth::getInstance()->getIdentity()->role;
        }
        $theResource = $request->getControllerName();
        $action = $request->getActionName();

        if (!$rightschecker->acl->isAllowed($role, $theResource, $action)) {
           $request->setControllerName('Error');
            $request->setActionName('denyaccess');
        }
    }
}
?>
