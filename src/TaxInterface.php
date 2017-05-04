<?php

namespace VoidInsight\Taxtotum\Libs;

/**
 * 
 */
interface TaxInterface {
    
    /**
     * @return float
     */
    public function getTaxable();
    
    /**
     * @param float $taxable
     * @return TaxInterface
     */
    public function setTaxable($taxable);
    
    /**
     * @return float
     */
    public function calculate();
}