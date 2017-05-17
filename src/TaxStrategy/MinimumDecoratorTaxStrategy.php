<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

use VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException;
use VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException;

/**
 * Strategy to limit minimum computated tax to a minimum value.
 */
class MinimumDecoratorTaxStrategy extends AbstractDecoratorTaxStrategy
{
    /**
     * @internal
     */
    const PARAM_MINIMUM_VALUE = 'PARAM_MINIMUM_VALUE';

    /**
     * Accessor method to get the Minimum value for the computated tax value.
     *
     * @return float
     */
    public function getTaxMinimum()
    {
        try {
            return $this->getParamValue(self::PARAM_MINIMUM_VALUE);
        } catch (ValueNotSettedException $exception) {
            throw new ItemNotSettedException('Tax Minimum limit not setted', 0, $exception);
        }
    }

    /**
     * Accessor method to set Minimum value for the computated tax value.
     *
     * @param float $minimum
     *
     * @return $this
     */
    public function setTaxMinimum($minimum)
    {
        $this->setParamValue(self::PARAM_MINIMUM_VALUE, $minimum);

        return $this;
    }

    public function calculate($taxable)
    {
        return max($this->getDecoratedStrategy()->calculate($taxable),
                    $this->getTaxMinimum());
    }
}
