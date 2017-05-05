<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

abstract class AbstractDecoratorTaxStrategy extends AbstractTaxStrategy {
    
    /**
     * @internal
     */
     const PARAM_DECORATED_STRATEGY = 'PARAM_DECORATED_STRATEGY';
     
     /**
      * @return TaxStrategyInterface
      */
     public function getDecoratedStrategy() {
        return $this->getParamValue(self::PARAM_DECORATED_STRATEGY);
     }
     
     /**
      * @param TaxStrategyInterface $strategy
      * 
      * @return $this
      */
     public function setDecoratedStrategy(TaxStrategyInterface $strategy) {
         $this->setParamValue(self::PARAM_DECORATED_STRATEGY, $strategy);
         
         return $this;
     }
}