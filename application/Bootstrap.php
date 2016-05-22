<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initRequest()
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
        
    }
    
    protected function _initPlaceholders() {
       
        $this->bootstrap('View');
       
        $view = $this->getResource('View');
        $view->doctype('XHTML1_STRICT');
        //Meta
        $view->headMeta()->appendName('keywords', 'framework, PHP')->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
        $view->headTitle('Admin Panel')->setSeparator(' :: ');
        // Set the initial stylesheet:
        // $view->headLink()->prependStylesheet('/ZendProject/public/css/bootstrap.css');
        $view->headLink()->appendStylesheet($view->baseUrl().'/css/bootstrap.min.css');
        $view->headLink()->appendStylesheet($view->baseUrl().'/font-awesome/css/font-awesome.min.css');
       

        $view->headScript()->appendFile($view->baseUrl().'/js/jquery.js');
         $view->headScript()->appendFile($view->baseUrl().'/js/jquery.min.js');
//        $view->headScript()->appendFile('http://localhost/html/rss/public/js/jquery-2.1.4.min.js');
        $view->headScript()->appendFile($view->baseUrl().'/js/bootstrap.min.js');
         $view->headScript()->appendFile($view->baseUrl().'/js/bootstrap.js');

    }
}

