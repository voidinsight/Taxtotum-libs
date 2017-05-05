<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Strategy Interface
 * 
 * A main interface to represents an implementation to calculate a Tax.
 * 
 * 
 * @package Taxtotum\Libs\Interfaces\Strategy
 */
interface TaxStrategyInterface {
    
    /**
     * Implementation of strategy
     * 
     * @param float $taxable
     * @return float
     */
    public function calculate($taxable);
}