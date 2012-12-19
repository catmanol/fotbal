<?php
/**
 * Description of tblGeneral
 *
 * @author Cata
 */
class My_View_Helper_TblMeci extends Zend_View_Helper_Abstract{
    public $view;

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    public function tblMeci($rowset) {
        $table="";
        if (count($rowset)>0) {
            $table.="<table class='spreadsheet'>";
            foreach($rowset as $item) {
                $table.="<tr><td>{$item['data']}</td><td>{$item['faza']}</td>";
                $table.="<td>{$item['nume']}</td><td>{$item['num']}</td>";
                $table.="<td>{$item['final_host']} - {$item['final_away']}</td>";
                $table.="<td><span id='".$item['id_meci']."' class='details' onclick='showDetailMeci()'>Details</span></td>";
                $table.="</tr>";
            }
            $table.="</table>";
            $table.="<div onclick='showDetailMeci()'>creset</div>";
        }
        return $table;
    }
}