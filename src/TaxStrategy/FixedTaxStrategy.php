<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

use VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException;
use VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException;

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
        return $this->getFixedTax();
    }

    /**
     * Accessor method to get the fixed value of tax.
     *
     * @return float
     */
    public function getFixedTax()
    {
        try {
            return $this->getParamValue(self::PARAM_FIXED_VALUE);
        } catch (ValueNotSettedException $exception) {
            throw new ItemNotSettedException('Fixed Tax value not setted', 0, $exception);
        }
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
