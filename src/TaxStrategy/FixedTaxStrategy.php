<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Concrete implementation.
 *
 * A strategy to computate a fixed tax independently from taxable amount provided
 */
class FixedTaxStrategy extends AbstractTaxStrategy
{
    /**
     * @internal
     */
    const PARAM_FIXED_VALUE = 'PARAM_FIXED_VALUE';

    public function calculate($taxable)
    {
        return $this->getParamValue(self::PARAM_FIXED_VALUE);
    }

    /**
     * Accessor method to get the fixed value of tax.
     *
     * @return float
     */
    public function getFixedTax()
    {
        return $this->getParamValue(self::PARAM_FIXED_VALUE);
    }

    /**
     * Accessor method to set the fixed value of tax.
     *
     * @param float $value
     *
     * @return $this
     */
    public function setFixedTax($value)
    {
        return $this->setParamValue(self::PARAM_FIXED_VALUE, $value);
    }
}
