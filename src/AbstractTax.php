<?php

namespace VoidInsight\Taxtotum\Libs;

/**
 * Base Abstract implementation Tax.
 *
 * A generic implementation to Tax class
 */
abstract class AbstractTax implements TaxInterface, TaxConfInterface
{
    /**
     * @internal
     */
    const PARAM_TAXABLE = 'PARAM_TAXABLE';

    /**
     * @internal
     *
     * @var array
     */
    private $params;

    public function getParamValue($paramName)
    {
        return $this->params[$paramName];
    }

    public function setParamValue($paramName, $value)
    {
        $this->params[$paramName] = $value;

        return $this;
    }

    public function getTaxable()
    {
        return $this->getParamValue(self::PARAM_TAXABLE);
    }

    public function setTaxable($taxable)
    {
        $this->setParamValue(self::PARAM_TAXABLE, $taxable);

        return $this;
    }

    abstract public function calculate();

    public function __construct()
    {
        $this->params = array();
    }
}
