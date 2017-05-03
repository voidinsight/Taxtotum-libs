<?php

namespace VoidInsight\Taxtotum\Libs\TaxBuilder;

use VoidInsight\Taxtotum\Libs\TaxInterface;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

use VoidInsight\Taxtotum\Libs\Tax;


class TaxBuilder extends AbstractTaxBuilder {
    
    /**
     * @var Tax
     */
    protected $tax;
    
    /**
     * @return TaxBuilder
     **/
    public function createTax() {
        $this->tax = new Tax;
        
        return $this;
    }
    
    /**
     * @param TaxStrategyInterface $strategy
     * @return TaxBuilder
     **/
    public function addStrategy(TaxStrategyInterface $strategy) {
        $this->tax->setStrategy($strategy);
    }
    
    /**
     * @return TaxInterface
     **/
    public function getTax() {
        return $this->tax;
    }
}