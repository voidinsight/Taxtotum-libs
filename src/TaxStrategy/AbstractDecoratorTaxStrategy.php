<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

use VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException;
use VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException;

/**
 * Common ancestror for Strategy Decorators.
 *
 * Decorator pattern is used to adjust computation algorithm of Strategy and
 * reduce numbers of Strategy needed.
 */
abstract class AbstractDecoratorTaxStrategy extends AbstractTaxStrategy
{
    /**
      * @internal
      */
     const PARAM_DECORATED_STRATEGY = 'PARAM_DECORATED_STRATEGY';

     /**
      * Accessor method to get the Decorated Strategy Object.
      *
      * @throws ItemNotSettedException
      * 
      * @return TaxStrategyInterface
      */
     public function getDecoratedStrategy()
     {
         try {
            return $this->getParamValue(self::PARAM_DECORATED_STRATEGY);
            
         } catch(ValueNotSettedException $exception) {
             throw new ItemNotSettedException('Decorated Strategy not setted', 0, $exception);
             
         }
     }

     /**
      * Accessor method to set the Decorated Strategy object.
      *
      * @param TaxStrategyInterface $strategy
      *
      * @return $this
      */
     public function setDecoratedStrategy(TaxStrategyInterface $strategy)
     {
         $this->setParamValue(self::PARAM_DECORATED_STRATEGY, $strategy);

         return $this;
     }
}
