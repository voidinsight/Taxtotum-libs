<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

class FixedTaxStrategy extends AbstractTaxStrategy {
    
    /**
     * @internal
     */
    const PARAM_FIXED_VALUE = 'PARAM_FIXED_VALUE';
    
    /**
     * @inheritdoc
     */
    public function calculate($taxable) {
        return $this->getParamValue(self::PARAM_FIXED_VALUE);
    }
}