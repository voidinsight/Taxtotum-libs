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
    
    /**
     * @return float
     */
    public function getFixedTax() {
        return $this->getParamValue(self::PARAM_FIXED_VALUE);
    }
    
    /**
     * @param float $value
     * 
     * @return FixedTaxStrategy
     */
    public function setFixedTax($value) {
        return $this->setParamValue(self::PARAM_FIXED_VALUE, $value);
    }
}