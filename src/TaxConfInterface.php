<?php

namespace VoidInsight\Taxtotum\Libs;

/**
 * 
 */
interface TaxConfInterface {
    
    /**
     * @param string $paramName
     * @return mixed
     */
    public function getParamValue($paramName);
    
    /**
     * @param string $paramName
     * @param mixed value
     * @return TaxConfInterface
     */
    public function setParamValue($paramName, $value);
}