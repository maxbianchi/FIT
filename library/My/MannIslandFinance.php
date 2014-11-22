<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MannIslandFinance
 *
 * @author max
 */
class My_MannIslandFinance {

    protected $soap;

    public function __construct() {
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $this->soap = $config->getOption('soap');
    }

    private function getUsername() {
        return $this->soap['username'];
    }

    private function getPassword() {
        return $this->soap['password'];
    }

    private function getSOAPendpoint() {
        return $this->soap['endpoint'];
    }

    public function getCompanies() {
        $client = new Zend_Soap_Client($this->getSOAPendpoint(), array('encoding' => 'UTF-8', 'soap_version' => SOAP_1_1));
        $auth = array("username" => $this->getUsername(), "password" => $this->getPassword());
        $result[0] = 0;
        try {
            $result[1] = $client->getCompanies($auth,$param);
        } catch (SOAPFault $f) {
            $result[0] = -1;
            $result[1] = $f->faultcode." ".$f->faultactor;
        }
        return $result;       
    }
    
    public function getQuote($symbol){
        $client = new Zend_Soap_Client($this->getSOAPendpoint(), array('encoding' => 'UTF-8', 'soap_version' => SOAP_1_1));
        $auth = array("username" => $this->getUsername(), "password" => $this->getPassword());
        $result[0] = 0;
        try {
            $result[1] = $client->getQuote($auth,$symbol);
        } catch (SOAPFault $f) {
            $result[0] = -1;
            $result[1] = $f->faultcode." - ".$f->faultactor;
        }
        return $result;  
    }
    
   public function getDirectorsBySymbol($symbol){
        $client = new Zend_Soap_Client($this->getSOAPendpoint(), array('encoding' => 'UTF-8', 'soap_version' => SOAP_1_1));
        $auth = array("username" => $this->getUsername(), "password" => $this->getPassword());
        $result[0] = 0;
        try {
            $result = $client->getDirectorsBySymbol($auth,$symbol);
        } catch (SOAPFault $f) {
            $result[0] = -1;
            $result[1] = $f->faultcode." - ".$f->faultactor;
        }
        return $result;  
    }

}
