<?php

namespace VoidInsight\Taxtotum\Libs;

use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

/**
 * Concrete Tax.
 *
 * A concrete implementation of Tax class. Using Strategy pattern to computate
 * tax value
 */
class Tax extends AbstractTax
{
    /**
     * @internal
     */
    const PARAM_STRATEGY = 'PARAM_STRATEGY';

    /**
     * Accessor method to get the Strategy implementation.
     */
    public function getStrategy()
    {
        return $this->getParamValue(self::PARAM_STRATEGY);
    }

    /**
     * Accessor method to set the Strategy implementation.
     */
    public function setStrategy(TaxStrategyInterface $strategy)
    {
        $this->setParamValue(self::PARAM_STRATEGY, $strategy);

        return $this;
    }

    /**
     * Concrete implementation.
     *
     * Call calculate method of Strategy implementation
     */
    public function calculate()
    {
        return
            $this->getStrategy()->calculate($this->getTaxable());
    }
}
