<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author cata
 */
class custom_jucator {
    public $cap=array();
    public function afisare($id,$country='') {
        $db=  Zend_Db_Table::getDefaultAdapter();
        switch ($id) {
            case 1:
                $select=$db->select()
                        ->from(array('p'=>'players_meci'),array())
                        ->join(array('j'=>'players'), 'p.id_juc=j.id_juc',array('jucator'=>'nume'))
                        ->join(array('t'=>'country'), 'p.id_country=t.id_tara',array('tara'=>'nume','meciuri'=>'COUNT(*)'))
                        ->where('t.nume LIKE ?', '%'.$country.'%')
                        ->group('p.id_juc')
                        ->order('meciuri DESC')
                        ->limit(20,0);
                $this->cap=array('Nr.','Nume','Tara','Meciuri');
                break;
            case 2:
                $select=$db->select()
                        ->from(array('p'=>'goluri'),array())
                        ->join(array('j'=>'players'), 'p.id_juc=j.id_juc',array('jucator'=>'nume'))
                        ->join(array('t'=>'country'), 'p.tara=t.presc',array('tara'=>'nume','goluri'=>'COUNT(*)'))
                        ->where('t.nume LIKE ?', '%'.$country.'%')
                        ->group('p.id_juc')
                        ->order('goluri DESC')
                        ->limit(20,0);
                $this->cap=array('Nr.','Nume','Tara','Goluri');
                break;
            case 3:
                $select=$db->select()
                        ->from(array('p'=>'avertizati'),array())
                        ->join(array('j'=>'players'), 'p.id_juc=j.id_juc',array('jucator'=>'nume'))
                        ->join(array('t'=>'country'), 'p.tara=t.presc',array('tara'=>'nume','avertismente'=>'COUNT(*)'))
                        ->where('t.nume LIKE ?', '%'.$country.'%')
                        ->group('p.id_juc')
                        ->order('avertismente DESC')
                        ->limit(20,0);
                $this->cap=array('Nr.','Nume','Tara','Avert');
                break;
            case 4:
                $select=$db->select()
                        ->from(array('p'=>'eliminati'),array())
                        ->join(array('j'=>'players'), 'p.id_juc=j.id_juc',array('jucator'=>'nume'))
                        ->join(array('t'=>'country'), 'p.tara=t.presc',array('tara'=>'nume','eliminati'=>'COUNT(*)'))
                        ->where('t.nume LIKE ?', '%'.$country.'%')
                        ->group('p.id_juc')
                        ->order('eliminati DESC')
                        ->limit(20,0);
                $this->cap=array('Nr.','Nume','Tara','Eliminari');
                break;
            case 5:
                $select=$db->select()
                        ->from(array('p'=>'players_meci'),array())
                        ->join(array('j'=>'players'), 'p.id_juc=j.id_juc',array('jucator'=>'nume'))
                        ->join(array('t'=>'country'), 'p.id_country=t.id_tara',array('tara'=>'nume','meciuri'=>'COUNT(*)'))
                        ->join(array('s'=>'scor_meci'),'p.id_meci=s.id_meci AND p.id_country=s.host',array('host'=>SUM()))
                        ->where('t.nume LIKE ?', '%'.$country.'%')
                        ->group('p.id_juc')
                        ->order('meciuri DESC')
                        ->limit(20,0);
                $this->cap=array('Nr.','Nume','Tara','Meciuri');
                $this->cap=array('Nr.','Nume','Tara','Eliminari');
                break;
            default:
                return NULL;
        }
        $stmt=$db->query($select);
        $stmt->setFetchmode(Zend_Db::FETCH_NUM);
        $result=$stmt->fetchAll();
        //$select="SELECT players_meci.id_juc,players.nume,country.nume,COUNT(*) as meciuri FROM `players_meci` JOIN players ON players_meci.id_juc=players.id_juc JOIN country ON players_meci.id_country=country.id_tara GROUP BY id_juc ORDER BY meciuri DESC";
        //$stmt=$db->query($select1);
        return $result;
    }
}

?>
