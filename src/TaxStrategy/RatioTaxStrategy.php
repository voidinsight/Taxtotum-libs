<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

class RatioTaxStrategy extends AbstractTaxStrategy {
    
    /**
     * @internal
     */
    const PARAM_RATIO_VALUE = 'PARAM_FIXED_VALUE';
    
    /**
     * @inheritdoc
     */
    public function calculate($taxable) {
        return (float)($taxable * $this->getParamValue(self::PARAM_RATIO_VALUE));
    }
}