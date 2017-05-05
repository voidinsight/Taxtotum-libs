<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Strategy to limit maximum tax to a defined value
 * 
 */
class MaximumDecoratorTaxStrategy extends AbstractDecoratorTaxStrategy {
    
    /**
     * @internal
     */
    const PARAM_MAXIMUM_VALUE = 'PARAM_MAXIMUM_VALUE';
    
    /**
     * @return float
     */
    public function getTaxMaximum() {
        return $this->getParamValue(self::PARAM_MAXIMUM_VALUE);
    }
    
    /**
     * @param float $maximum
     * 
     * @return $this
     */
    public function setTaxMaximum($maximum) {
        $this->setParamValue(self::PARAM_MAXIMUM_VALUE, $maximum);
        
        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function calculate($taxable) {
        return min($this->getDecoratedStrategy()->calculate($taxable),
                    $this->getTaxMaximum());
    }
}