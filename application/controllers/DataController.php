<?php

class DataController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function searchAction() {
        $searchform = new Application_Form_Searchform();
        $searchform->setAttrib('onsubmit', 'return doCheckDates();');
        $this->view->form = $searchform;
        if ($this->getRequest()->isPost()) {
            $inputdata = $this->getRequest()->getPost();
            $venue = $inputdata['venue'];
            $type = $inputdata['type'];
            $fromdate = $inputdata['fromdate'];
            $todate = $inputdata['todate'];
            if ($searchform->isValid($inputdata)) {
                $db = new Application_Model_DbTable_ShowsTable();
                if ($venue !== 'Any') {
                    $db->select()
                            ->where('venue = ?', $venue);
                }
                if ($type !== 'All') {
                    $db->select()
                            ->where('genre = ?', $type);
                }
                $db->select()
                        ->where('startseason >= ? and endseason <= ?', $fromdate, $todate);
                $data = $db->fetchAll();
                $this->view->report = $data;
            } else {
                $searchform->populate($inputdata);
            }
        }
    }

    public function showshowAction() {
        if ($this->getRequest()->getMethod() == 'GET') {
            $id = $this->_getParam('id');
            if ($id) {
                $db = new Application_Model_DbTable_ShowsTable();
                $selector = $db->select();
                $selector->where('mykey = ?', $id);
                $data = $db->fetchRow($selector);
                if ($data) {
                    $this->view->show = $data;
                    $db = new Application_Model_DbTable_PerformancesTable();
                    $selector = $db->select();
                    $selector->where('showid = ?', $id);
                    $data = $db->fetchAll($selector);
                    $this->view->performances = $data;
                    $db = new Application_Model_DbTable_InfoTable();
                    $selector = $db->select();
                    $selector->where('showid = ?', $id);
                    $data = $db->fetchAll($selector);
                    $this->view->info = $data;
                }
            }
        } else {
            
        }
    }

    public function scheduleAction() {
        if ($this->getRequest()->isPost()) {
            $mykey = $this->getRequest()->getPost('identifier');
            $venue = $this->getRequest()->getPost('venue');
            $startseason = $this->getRequest()->getPost('fromdate');
            $endseason = $this->getRequest()->getPost('todate');
            $genre = $this->getRequest()->getPost('type');
            $title = $this->getRequest()->getPost('title');
            $company = $this->getRequest()->getPost('company');
            $shortdescription = $this->getRequest()->getPost('description');
            $showsTable = new Application_Model_DbTable_ShowsTable();
            $showdata = array('mykey' => $mykey, 'venue' => $venue,
                'startseason' => $startseason, 'endseason' => $endseason,
                'genre' => $genre, 'title' => $title, 'company' => $company,
                'shortdescription' => $shortdescription);
            $showsTable->insert($showdata);
            $performances = explode(';', $this->getRequest()->getPost('performances'));
            if ($performances) {
                foreach ($performances as $aperformance) {
                    if (strlen($aperformance) > 0) {
                        $parts = explode(', ', $aperformance);
                        $performancesTable = new Application_Model_DbTable_PerformancesTable;
                        $performancesTable->insert(array('showid' => $mykey, 'showtime' => $parts[1],
                            'showdate' => $parts[0]));
                    }
                }
            }
            $this->view->record = $showdata;
        } else {
            $addshowform = new Application_Form_Addshowform();
            $this->view->form = $addshowform;
        }
    }

    public function addinfoAction() {
        if ($this->getRequest()->isPost()) {
            $showid = $this->getRequest()->getPost('identifier');
            foreach ($this->getRequest()->getPost() as $key => $value) {
                if (substr($key, 0, 3) === 'img') {
                    $num = substr($key, 3);
                    $details = $this->getRequest()->getPost('info' . $num);
                    $infoTable = new Application_Model_DbTable_InfoTable();
                    $infodata = array('showid' => $showid, 'details' => $details,
                        'picy' => $value);
                    $infoTable->insert($infodata);
                }
            }
            $db = new Application_Model_DbTable_ShowsTable();
            $selector = $db->select();
            $selector->where('mykey = ?', $showid);
            $data = $db->fetchRow($selector);
            if ($data) {
                $this->view->show = $data;
            }
        }
    }

}
