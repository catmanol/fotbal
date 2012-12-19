<?php

class Application_Model_DbTable_Awards extends Zend_Db_Table_Abstract
{

    protected $_name = 'wc';
    protected $_primary = 'an';
    protected $_referenceMap=array(
        'TaraGazda'=>array(
            'columns'=>'tara_gazda',
            'refTableClass'=>'Application_Model_DbTable_Country',
            'refColumns'=>'id_tara'
        ),
    );
    public function getHost() {
        $rowSet=$this->fetchAll();
    }
}

