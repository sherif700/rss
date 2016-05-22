<?php

class Application_Form_Feed extends Zend_Form
{

    public function init()
    {
        $path = new Zend_Form_Element_Text('rss_path');
        $path->setRequired();
        $path->setLabel('title')->setAttrib('class', 'form-label');
        $path->setAttrib('class', 'form-control col-md-1');
        $path->setAttrib('style', 'width:50%');
        $path->addValidator(new Zend_Validate_Db_NoRecordExists(
                array(
            'table' => 'rss_feed',
            'field' => 'rss_path'
                )
        ));
	 	$id = new Zend_Form_Element_Hidden('id');
		$submit = new Zend_Form_Element_Submit('submit');
                $submit->setAttrib('class', 'btn btn-primary col-md-2');
                $submit->setAttrib('style', 'margin-top:-20px');

        $this->addElements(array($id, $path ,$submit));
    }



}

