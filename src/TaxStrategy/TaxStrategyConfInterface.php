<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

/**
 * Strategy Configuration Interface.
 *
 * An interface to configure a specific strategy
 */
interface TaxStrategyConfInterface
{
    /**
     * Accessor method to read a custom param.
     *
     * @param string $paramName
     *
     * @return mixed
     */
    public function getParamValue($paramName);

    /**
     * Accessor method to write a custom param.
     *
     * @param string $paramName
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParamValue($paramName, $value);
}
