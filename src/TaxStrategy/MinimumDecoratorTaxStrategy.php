<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

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
        $tax = $this->getDecoratedStrategy()->calculate($taxable);
        $minimum = $this->getTaxMinimum();
        
        if($tax < $minimum) {
            $tax = $minimum;
        }
        
        return $tax;
    }
}