<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Common ancestror for Strategies.
 *
 * An abstract implementation of Strategy pattern.
 */
abstract class AbstractTaxStrategy implements TaxStrategyInterface, TaxStrategyConfInterface
{
    /**
     * @internal
     */
    private $params;

    abstract public function calculate($taxable);

    public function getParamValue($paramName)
    {
        return $this->params[$paramName];
    }

    public function setParamValue($paramName, $value)
    {
        $this->params[$paramName] = $value;

        return $this;
    }
}
