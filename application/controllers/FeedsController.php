<?php

class FeedsController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Feed();
    }

    public function indexAction() {
        // action body
    }

    public function viewAction() {
        // action body
        $links = $this->model->listFeeds();
        $channel = [];
        foreach ($links as $value) {
            $news = new Zend_Feed_Rss($value['rss_path']);
            foreach ($news as $new) {
                array_push($channel, array('title' => $new->title(), 'description' => $new->description(), 'pubDate' => $new->pubDate(), 'link' => $new->link(), 'cat' => $new->author()));
            }
        }
        $this->view->channel = $channel;
    }

    public function addAction() {

        $links = $this->model->listFeeds();

        $form = new Application_Form_Feed();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $ext = (new SplFileInfo($data['rss_path']))->getExtension();
                if ($ext != '' && $ext == 'rss') {

                    if ($this->model->add($data)) {
                        $this->redirect('feeds/add');
                    }
                } else {
                    $this->view->Error = "plz enter .rss link";
                }
            }
        }
        $this->view->form = $form;
        $this->view->links = $links;
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        $this->model->deleteFeed($id);
        $this->redirect('feeds/add');
    }

    public function editAction() {
        $form = new Application_Form_Feed();
        $id = $this->getRequest()->getParam('id');
        $feed = $this->model->getFeedById($id);
        $form->populate($feed[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $ext = (new SplFileInfo($data['rss_path']))->getExtension();
                if ($ext != '' && $ext == 'rss') {
                    if ($this->model->editFeed($id, $data)) {
                        $this->redirect('feeds/add');
                    }
                } else {
                    $this->view->Error = "plz enter .rss link";
                }


                // $data = $form->getValues();
                // if ($this->model->editFeed($id, $data)) {
                //     $this->redirect('feeds/add');
                // }
            }
        }
        $this->view->form = $form;
    }

    public function sherifAction() {
        // action body
    }

}
