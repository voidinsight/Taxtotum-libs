<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Common ancestror for Strategy Decorators.
 * 
 * Decorator pattern is used to adjust computation algorithm of Strategy and
 * reduce numbers of Strategy needed.
 * 
 * 
 * @package Taxtotum\Libs\Classes\Strategy\Decorator
 */
abstract class AbstractDecoratorTaxStrategy extends AbstractTaxStrategy {
    
    /**
     * @internal
     */
     const PARAM_DECORATED_STRATEGY = 'PARAM_DECORATED_STRATEGY';
     
     /**
      * Accessor method to get the Decorated Strategy Object
      * 
      * @return TaxStrategyInterface
      */
     public function getDecoratedStrategy() {
        return $this->getParamValue(self::PARAM_DECORATED_STRATEGY);
     }
     
     /**
      * Accessor method to set the Decorated Strategy object
      * 
      * @param TaxStrategyInterface $strategy
      * 
      * @return $this
      */
     public function setDecoratedStrategy(TaxStrategyInterface $strategy) {
         $this->setParamValue(self::PARAM_DECORATED_STRATEGY, $strategy);
         
         return $this;
     }
}