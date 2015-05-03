<?php

class NABG_View_Helper_Html5Helper extends Zend_View_Helper_FormText {
    
    public function html5Helper($name, $value=null, $attribs=null)
    {
        $info = $this->_getInfo($name,$value,$attribs);
        extract($info);
         // build the element
        $disabled = '';
        if ($disable) {
            // disabled
            $disabled = ' disabled="disabled"';
        }
        $thetype = 'text';
        if(array_key_exists('thetype',$attribs)) {
            $thetype = $attribs['thetype'];
            unset($attribs['thetype']);
        }
        
        
        $requiredstr = '';
        if(array_key_exists('required',$attribs)) {
            $requiredstr='required';
        }
        // XHTML or HTML end tag?
        $endTag = ' />';
        if (($this->view instanceof Zend_View_Abstract) && !$this->view->doctype()->isXhtml()) {
            $endTag= '>';
        }

        $xhtml = '<input type="' . $thetype . '"'
                . ' name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . ' value="' . $this->view->escape($value) . '"'
                . $disabled
                . $requiredstr
                . $this->_htmlAttribs($attribs)
                . $endTag;

        return $xhtml;
    }
}