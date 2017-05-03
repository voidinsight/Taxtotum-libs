<?php

namespace VoidInsight\Taxtotum\Libs;

abstract class AbstractTax implements TaxInterface {
    
    /**
     * @var float
     **/
    private $taxable = 0.0;
    
    /**
     * @return TaxInterface
     **/
    public function getTaxable() {
        return $this->taxable;
    }
    
    /**
     * @param float $taxable
     * @return TaxInterface
     **/
    public function setTaxable($taxable) {
        $this->taxable = $taxable;
        
        return $this;
    }
    
    /**
     * @return float
     **/
    abstract function calculate();
}