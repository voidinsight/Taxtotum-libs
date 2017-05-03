<?php

namespace VoidInsight\Taxtotum\Libs;

use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

class Tax extends AbstractTax {
    
    /**
     * @var TaxStrategyInterface
     **/
    protected $strategy;
    
    /**
     * @reutrn TaxStrategyInterface
     **/
    public function getStrategy() {
        return $strategy;
    }
    
    /**
     * @param TaxStrategyInterface $strategy
     * @return Tax
     **/
    public function setStrategy(TaxStrategyInterface $strategy) {
        $this->strategy = $strategy;
        
        return $this;
    }
    
    /**
     * @return float
     **/
    public function calculate() {
        $strategy = $this->getStrategy();
        $taxable = $this->getTaxable();
        var_dump($strategy, $taxable);
        return $strategy->calculate($taxable);
    }
}