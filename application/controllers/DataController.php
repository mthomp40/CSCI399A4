<?php

class DataController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function doaAction()
    {
         $db = new Application_Model_DbTable_MoviesTable();
        $select = $db->select();
        $select->order(array('year'));
        $data = $db->fetchAll($select);
        $this->view->movies = $data;
    }

    public function dobAction()
    {
        // This is the restricted access action
    }


}





