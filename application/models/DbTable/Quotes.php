<?php

class Application_Model_DbTable_Quotes extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'quotes';
    protected $_primary = 'id';
    
    public function saveQuotes($companies, $quotes)
    {
        $data = array("companies" => $companies, "quotes" => $quotes);
        $this->insert($data);
    }
    
    public function getLastFive()
    {
        $result = $this->select()->order("id DESC")->limit(5);
        return $this->getAdapter()->fetchAssoc($result); 
    }
}
