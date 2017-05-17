<?php

namespace VoidInsight\Taxtotum\Libs;

use VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException;
use VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException;
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
        try {
            $strategy = $this->getParamValue(self::PARAM_STRATEGY);

            return $strategy;
        } catch (ValueNotSettedException $exception) {
            throw new ItemNotSettedException('Strategy Object not setted', 0, $exception);
        }
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
