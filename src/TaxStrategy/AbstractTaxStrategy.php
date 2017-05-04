<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

abstract class AbstractTaxStrategy implements TaxStrategyInterface, TaxStrategyConfInterface {
    
    private $params;
    
    /**
     * {@inheritdoc}
     **/
    abstract public function calculate($taxable);
    
    /**
     * {@inheritdoc}
     **/
     public function getParamValue($paramName) {
         return $this->params[$paramName];
     }
     
     /**
     * {@inheritdoc}
     **/
     public function setParamValue($paramName, $value) {
         $this->params[$paramName] = $value;
         
         return $this;
     }
}