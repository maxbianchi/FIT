<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {                    
        $soap = new My_MannIslandFinance();
        $companies = $soap->getCompanies();
        $this->view->companies = $companies[1];        
        $model = new Application_Model_DbTable_Quotes();
        $this->view->lastFive = $model->getLastFive();
    }

    public function getQuoteAction()
    {
        $soap = new My_MannIslandFinance();
        $symbol = $this->getRequest()->getParam('symbol');
        $quote = $soap->getQuote($symbol);
        $this->getHelper('json')->sendJson($quote);
    }
    
    public function getDirectorsBySymbolAction()
    {
        $soap = new My_MannIslandFinance();
        $symbol = $this->getRequest()->getParam('symbol');
        $director = $soap->getDirectorsBySymbol($symbol);
        $this->getHelper('json')->sendJson($director);
    }
    
    public function storeQuotesAction()
    {
        $companies = $this->getRequest()->getParam('companies');
        $quotes = $this->getRequest()->getParam('quotes');
        $model = new Application_Model_DbTable_Quotes();
        $model->saveQuotes($companies, $quotes);
        $this->getHelper('json')->sendJson(array());
    }
    
    public function getLastFiveAction()
    {
        $model = new Application_Model_DbTable_Quotes();
        $five = $model->getLastFive();
        $this->getHelper('json')->sendJson($five);
    }        
}

