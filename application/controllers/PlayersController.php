<?php

class PlayersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $table=new Application_Model_DbTable_Interogari;
        $where=$table->select()
                ->where('gen LIKE ?','%jucator%');
        $list=$table->fetchAll($where);
        $this->view->questions=$list;
        $test=$this->_getParam('test');
        if (!isset($test)) 
            $test=0;
        $filtru=$this->_getParam('tara');
        $rez=new custom_jucator();
        $testare=$rez->afisare($test,$filtru);
        if ($testare!==NULL) {
            $row=$table->fetchRow($table->select()->where('id_query=?',$test));
            $titlu=$row->intrebare;
            $this->view->titlu=$titlu;
            $this->view->cap=$rez->cap;
            $this->view->result=$testare;
            $this->view->id=$test;
        }
    }

    public function ajaxAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        if ($this->getRequest()->isXmlHttpRequest()) {
            $data=$_POST['q'];
            $tbl=new Application_Model_DbTable_Country();
            $query=$tbl->select()
                ->from($tbl,array('nume'))
                ->where('nume LIKE ?','%'.$data.'%')
                ->limit(5,0);
            $list=$tbl->fetchAll($query);
            echo "<ul id='ul_sel_tara'>";
            foreach ($list as $val) {
                echo "<li>".$val['nume']."</li>";  
            }
            echo "</ul>";
        }
    }


}



