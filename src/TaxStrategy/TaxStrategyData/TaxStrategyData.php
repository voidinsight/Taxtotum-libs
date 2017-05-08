<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData;

class TaxStrategyData implements TaxStrategyDataInterface {
    
    /**
     * @internal
     */
    public function __set($property, $value) {
       $this->$property = $value; 
    }
}