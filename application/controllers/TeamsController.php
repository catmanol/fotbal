<?php

class TeamsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $control='team';
        $this->view->control=$control;
    }


}

