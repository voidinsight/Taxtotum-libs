<?php

namespace VoidInsight\Taxtotum\Libs\TaxBuilder;

use VoidInsight\Taxtotum\Libs\TaxInterface;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;


interface TaxBuilderInterface {
    
    /**
     * @reutrn TaxBuilderInterface
     **/
    public function createTax();
    
    /**
     * @param TaxStrategyInterface $strategy
     * @return TaxBuilderInterface
     **/
    public function addStrategy(TaxStrategyInterface $strategy);
    
    /**
     * @return TaxInterface
     **/
    public function getTax();
}