<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

interface TaxStrategyConfInterface {
    
    /**
     * @param string $paramName
     * @return mixed
     **/
    public function getParamValue($paramName);
    
    /**
     * @param string $paramName
     * @param mixed $value
     * @return TaxStrategyBuilderInterface
     **/
    public function setParamValue($paramName, $value);
}