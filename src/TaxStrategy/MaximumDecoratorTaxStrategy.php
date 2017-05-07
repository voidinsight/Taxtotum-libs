<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Strategy to limit maximum computated tax to a defined value.
 */
class MaximumDecoratorTaxStrategy extends AbstractDecoratorTaxStrategy
{
    /**
     * @internal
     */
    const PARAM_MAXIMUM_VALUE = 'PARAM_MAXIMUM_VALUE';

    /**
     * Accessor method to get Maximum value for the computated tax value.
     *
     * @return float
     */
    public function getTaxMaximum()
    {
        return $this->getParamValue(self::PARAM_MAXIMUM_VALUE);
    }

    /**
     * Accessor method to set Maximum value for the computated tax value.
     *
     * @param float $maximum
     *
     * @return $this
     */
    public function setTaxMaximum($maximum)
    {
        $this->setParamValue(self::PARAM_MAXIMUM_VALUE, $maximum);

        return $this;
    }

    public function calculate($taxable)
    {
        return min($this->getDecoratedStrategy()->calculate($taxable),
                    $this->getTaxMaximum());
    }
}
