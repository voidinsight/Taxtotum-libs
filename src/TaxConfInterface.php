<?php

namespace VoidInsight\Taxtotum\Libs;

/**
 * Tax Configuration Interface.
 *
 * A interface usable to configure a Tax class.
 */
interface TaxConfInterface
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
     * @param mixed value
     *
     * @return $this
     */
    public function setParamValue($paramName, $value);
}
