<?php

class Application_Form_Addshowform extends Zend_Form {

    public function init() {

        $this->setMethod('post');
        
        $identifier = new Zend_Form_Element_Text('identifier');
        $identifier->setLabel('Show identifier');
        $identifier->setAttrib('size', 32);
        $identifier->setAttrib('required', true);
        $identifier->addFilter('Alnum');
        $identifier->addValidator('StringLength', false, array('min' => 2, 'max' => 32));

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title');
        $title->setAttrib('size', 50);
        $title->setAttrib('required', true);
        $title->addFilter('Alnum');
        $title->addValidator('StringLength', false, array('min' => 2, 'max' => 50));

        $venue = new Zend_Form_Element_Select('venue');
        $venue->setLabel('Venue');
        $venue->addMultiOption('Opera', 'Opera');
        $venue->addMultiOption('Concert', 'Concert');
        $venue->addMultiOption('Playhouse', 'Playhouse');
        $venue->addMultiOption('Studio', 'Studio');
        $venue->setValue('Opera');

        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Type');
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
        $type->setValue('Drama');
        
        $fromdate = new NABG_Element_HTML5TextType('fromdate');
        $fromdate->setAttrib('thetype', 'date');
        $fromdate->setLabel("From date");

        $todate = new NABG_Element_HTML5TextType('todate');
        $todate->setAttrib('thetype', 'date');
        $todate->setLabel("To date");

        $company = new Zend_Form_Element_Text('company');
        $company->setLabel('Company');
        $company->setAttrib('size', 50);
        $company->setAttrib('required', true);
        $company->addFilter('Alnum');
        $company->addValidator('StringLength', false, array('min' => 2, 'max' => 50));

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Description');
        $description->setAttrib('cols', 80);
        $description->setAttrib('rows', 4);
        $description->setAttrib('required', true);
        $description->addFilter('Alnum');
        $description->addValidator('StringLength', false, array('min' => 2, 'max' => 128));

        $performances = new Zend_Form_Element_Textarea('performances');
        $performances->setLabel('Performances');
        $performances->setAttrib('readonly', true);
        $performances->setAttrib('cols', 80);
        $performances->setAttrib('rows', 4);
        $performances->addFilter('Alnum');

        $addevent = $this->createElement('submit', 'submit');
        $addevent->setLabel("Add event");

        $this->addElements(array(
            $identifier,
            $title,
            $venue,
            $type,
            $fromdate, $todate,
            $company,
            $description,
            $performances,
            $addevent
        ));

        $this->addDisplayGroup(array(
            'identifier',
            'title',
            'venue',
            'type',
            'fromdate', 'todate',
            'company',
            'description',
            'performances',
            'submit'
                ), 'inputdata', array('legend' => 'Add a show'));
        
    }

}
