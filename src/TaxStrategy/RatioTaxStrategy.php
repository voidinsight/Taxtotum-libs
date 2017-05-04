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
    
    /**
     * @return float
     */
    public function getRatioValue() {
        return $this->getParamValue(self::PARAM_RATIO_VALUE);
    }
    
    /**
     * @param float $ratio
     * @return RatioTaxStrategy
     */
    public function setRatioValue($ratio) {
        return $this->setParamValue(self::PARAM_RATIO_VALUE, $ratio);
    }
}