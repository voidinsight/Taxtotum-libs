<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

class LimitDecoratorTaxStrategy extends AbstractDecoratorTaxStrategy {
    
    /**
     * @internal
     */
    const PARAM_LIMIT_VALUE = 'PARAM_LIMIT_VALUE';
    
    /**
     * @return float
     */
    public function getTaxLimit() {
        return $this->getParamValue(self::PARAM_LIMIT_VALUE);
    }
    
    /**
     * @param float $limit
     * 
     * @return $this
     */
    public function setTaxLimit($limit) {
        $this->setParamValue(self::PARAM_LIMIT_VALUE, $limit);
        
        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function calculate($taxable) {
        $tax = $this->getDecoratedStrategy()->calculate($taxable);
        $limit = $this->getTaxLimit();
        
        if($tax > $limit) {
            $tax = $limit;
        }
        
        return $tax;
    }
}