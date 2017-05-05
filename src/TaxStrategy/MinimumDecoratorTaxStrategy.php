<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Strategy to limit minimum computated tax to a minimum value
 * 
 */
class MinimumDecoratorTaxStrategy extends AbstractDecoratorTaxStrategy {
    
    /**
     * @internal
     */
    const PARAM_MINIMUM_VALUE = 'PARAM_MINIMUM_VALUE';
    
    /**
     * @return float
     */
    public function getTaxMinimum() {
        return $this->getParamValue(self::PARAM_MINIMUM_VALUE);
    }
    
    /**
     * @param float $limit
     * 
     * @return $this
     */
    public function setTaxMinimum($minimum) {
        $this->setParamValue(self::PARAM_MINIMUM_VALUE, $minimum);
        
        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function calculate($taxable) {
        return max($this->getDecoratedStrategy()->calculate($taxable),
                    $this->getTaxMinimum());
    }
}