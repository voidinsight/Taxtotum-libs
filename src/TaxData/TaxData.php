<?php

namespace VoidInsight\Taxtotum\Libs\TaxData;

class TaxData implements TaxDataInterface {
    
    public function __set($property, $value) {
        $this->$property = $value;
    }
    
}