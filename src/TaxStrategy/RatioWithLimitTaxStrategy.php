<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

class RatioWithLimitTaxStrategy extends RatioTaxStrategy {
    
    /**
     * @internal
     */
    const PARAM_LIMIT_VALUE = 'PARAM_LIMIT_VALUE';
    
    /**
     * @inheritdoc
     */
    public function calculate($taxable) {
        $value = parent::calculate($taxable);
        $limit = $this->getTaxLimitValue();
        
        if($value >= $limit) {
            $value = $limit;
        }
        
        return $value;
    }
    
    /**
     * @return float
     */
    public function getTaxLimitValue() {
        return $this->getParamValue(self::PARAM_LIMIT_VALUE);
    }
    
    /**
     * @param float $limit
     * @return RatioWithLimitTaxStrategy
     */
    public function setTaxLimitValue($limit) {
        return $this->setParamValue(self::PARAM_LIMIT_VALUE, $limit);
    }
}