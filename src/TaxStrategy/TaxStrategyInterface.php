<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

interface TaxStrategyInterface {
    
    /**
     * @param float $taxable
     * @return float
     **/
    public function calculate($taxable);
}