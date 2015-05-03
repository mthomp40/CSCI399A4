<?php

class Application_Form_Scheduleeventform extends Zend_Form {

    public function init() {

        $this->setMethod('post');
        // This form uses HTML5 - so the browser will do some
        // validation anyway along with supplying more sophisticated
        // input fields
        // Some elements have validators defined - checking on
        // receipt of data (you can never trust browser checks,
        // the data submitted may have been hand crafted by a hacker)

        $identifier = new Zend_Form_Element_Text('identifier');
        $identifier->setLabel('Show identifier');
        $identifier->setAttrib('size', 50);
        $identifier->setAttrib('required', true);
        $identifier->addFilter('Alnum');
        $identifier->addValidator('StringLength', false, array('min' => 2, 'max' => 50));

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title');
        $title->setAttrib('size', 100);
        $title->setAttrib('required', true);
        $title->addFilter('Alnum');
        $title->addValidator('StringLength', false, array('min' => 2, 'max' => 100));

        $venue = new Zend_Form_Element_Select('venue');
        $venue->setLabel('Venue');
        $venue->addMultiOption('Concert', 'Concert');

        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Type');
        $type->addMultiOption('World Music', 'World Music');

        $fromdate = new NABG_Element_HTML5TextType('fromdate');
        $fromdate->setAttrib('thetype', 'date');
        $fromdate->setLabel("From date");

        $todate = new NABG_Element_HTML5TextType('todate');
        $todate->setAttrib('thetype', 'date');
        $todate->setLabel("To date");

        $company = new Zend_Form_Element_Text('company');
        $company->setLabel('Company');
        $company->setAttrib('size', 100);
        $company->setAttrib('required', true);
        $company->addFilter('Alnum');
        $company->addValidator('StringLength', false, array('min' => 2, 'max' => 100));

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Description');
        $description->setAttrib('size', 1000);
        $description->setAttrib('required', true);
        $description->addFilter('Alnum');
        $description->addValidator('StringLength', false, array('min' => 2, 'max' => 1000));

        $performances = new Zend_Form_Element_Textarea('performances');
        $performances->setLabel('Performances');
        $performances->setAttrib('size', 1000);
        $performances->setAttrib('required', true);
        $performances->addFilter('Alnum');
        $performances->addValidator('StringLength', false, array('min' => 2, 'max' => 1000));


        $submit = $this->createElement('submit', 'submit');

        $submit->setLabel("Submit data ");

        $this->addElements(array(
            $identifier,
            $title,
            $venue,
            $type,
            $fromdate, $todate,
            $company,
            $description,
            $performances,
            $submit
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
