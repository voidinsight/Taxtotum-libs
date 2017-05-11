<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

use VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException;
use VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException;

/**
 * Concrete implementation.
 *
 * A strategy to computate a tax value appling a percentual factor to taxable amount
 */
class RatioTaxStrategy extends AbstractTaxStrategy
{
    /**
     * @internal
     */
    const PARAM_RATIO_VALUE = 'PARAM_FIXED_VALUE';

    public function calculate($taxable)
    {
        return (float) ($taxable * $this->getParamValue(self::PARAM_RATIO_VALUE));
    }

    /**
     * Accessor method to get Ratio between Taxable and Tax value.
     *
     * @return float
     */
    public function getRatioValue()
    {
        try {
            return $this->getParamValue(self::PARAM_RATIO_VALUE);
        } catch(ValueNotSettedException $exception) {
            throw new ItemNotSettedException('Tax Ratio value not setted', 0, $exception);
        }
        
    }

    /**
     * Accessor method to set Ratio between Taxable and Tax value.
     *
     * @param float $ratio
     *
     * @return $this
     */
    public function setRatioValue($ratio)
    {
        return $this->setParamValue(self::PARAM_RATIO_VALUE, $ratio);
    }
}
