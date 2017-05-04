<?php

namespace VoidInsight\Taxtotum\Libs;

/**
 * 
 */
abstract class AbstractTax implements TaxInterface, TaxConfInterface {
    
    /**
     * @internal
     */
    const PARAM_TAXABLE = 'PARAM_TAXABLE';
    
    /**
     * @var array
     */
    private $params;
    
    /**
     * {@inheritdoc}
     */
    public function getParamValue($paramName) {
       return $this->params[$paramName];
    }
    
    /**
     * {@inheritdoc}
     */
    public function setParamValue($paramName, $value) {
        $this->params[$paramName] = $value;
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTaxable() {
        return $this->getParamValue(self::PARAM_TAXABLE);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setTaxable($taxable) {
        $this->setParamValue(self::PARAM_TAXABLE, $taxable);
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    abstract function calculate();
    
    public function __construct() {
        $this->params = array();
    }
}