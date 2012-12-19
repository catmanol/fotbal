<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $host=new Application_Model_DbTable_Awards;
        $this->view->host=$host;
    }

    public function wcAction()
    {
        $wc=$this->_getParam('id',0);
        $this->view->wc=$wc;
        $db=Zend_Db_Table::getDefaultAdapter();
        $select=$db->select()
                   ->from(array('m'=>'meci'),
                          array('m.id_meci','m.data','m.faza'))
                   ->join(array('s'=>'scor_meci'),
                          'm.id_meci=s.id_meci',array('s.final_host','s.final_away'))
                   ->join(array('c'=>'country'),
                          's.host=c.id_tara',array('c.nume'))
                   ->join(array('t'=>'tari'),
                          's.away=t.id_tar',array('t.num'))
                   ->where('wc=?',$wc)
                   ->order(array('data ASC'));
        $stmt=$db->query($select);
        $result=$stmt->fetchAll();
        $this->view->result=$result;

    }


}









