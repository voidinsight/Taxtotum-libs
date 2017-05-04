<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

class DummyTaxStrategy extends AbstractTaxStrategy {
    
    /**
     * {@inheritdoc}
     **/
    public function calculate($taxable) {
        return $taxable;
    }
}