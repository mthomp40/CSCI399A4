<?php

class Application_Form_Searchform extends Zend_Form {

    public function init() {

        $this->setMethod('post');
        
        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Type');
        $type->addMultiOption('All', 'All');
        $type->addMultiOption('Drama', 'Drama');
        $type->addMultiOption('Film', 'Film');
        $type->addMultiOption('Opera', 'Opera');
        $type->addMultiOption('Jazz', 'Jazz');
        $type->addMultiOption('World Music', 'World Music');
        $type->addMultiOption('Ballet', 'Ballet');
        $type->addMultiOption('Recital', 'Recital');
        $type->addMultiOption('Concert', 'Concert');
        $type->addMultiOption('Choral', 'Choral');
        $type->addMultiOption('Contemporary Dance', 'Contemporary Dance');
        $type->addMultiOption('Comedy', 'Comedy');
        $type->addMultiOption('Children', 'Children');

        $venue = new Zend_Form_Element_Select('venue');
        $venue->setLabel('Venue');
        $venue->addMultiOption('Any', 'Any');
        $venue->addMultiOption('Opera', 'Opera');
        $venue->addMultiOption('Concert', 'Concert');
        $venue->addMultiOption('Playhouse', 'Playhouse');
        $venue->addMultiOption('Studio', 'Studio');

        $fromdate = new NABG_Element_HTML5TextType('fromdate');
        $fromdate->setAttrib('thetype', 'date');
        $fromdate->setLabel("From date");

        $todate = new NABG_Element_HTML5TextType('todate');
        $todate->setAttrib('thetype', 'date');
        $todate->setLabel("To date");

        $search = $this->createElement('submit', 'submit');
        $search->setLabel("Search");

        $this->addElements(array(
            $type,
            $venue,
            $fromdate, $todate,
            $search
        ));

        $this->addDisplayGroup(array(
            'type',
            'venue',
            'fromdate', 'todate',
            'submit'
                ), 'inputdata', array('legend' => 'Search for shows'));
    }

}
