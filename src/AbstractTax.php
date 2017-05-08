<?php

namespace VoidInsight\Taxtotum\Libs;

use VoidInsight\Taxtotum\Libs\TaxData\TaxData;
use VoidInsight\Taxtotum\Libs\TaxData\TaxDataInterface;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

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
     * @var PropertyAccessorInterface
     */
    private $accessor;

    /**
     * @return PropertyAccessorInterface
     */
    public function getAccessor() {
        return $this->accessor;
    }
    
    /**
     * @param PropertyAccessorInterface $accessor
     * 
     * @return $this
     */
    public function setAccessor(PropertyAccessorInterface $accessor) {
        $this->accessor = $accessor;
        
        return $this;
    }
    
    /**
     * @internal
     *
     * @var TaxDataInterface
     */
    private $params;
    
    /**
     * @return TaxDataInterface
     */
    public function getData() {
        return $this->params;
    }
    
    /**
     * @param TaxDataInterface $taxData
     * 
     * @return $this
     */
    public function setData(TaxDataInterface $taxData) {
        $this->params = $taxData;
        
        return $this;
    }
    
    public function getParamValue($paramName)
    {
        return $this->getAccessor()
                        ->getValue($this->getData(), $paramName);
    }

    public function setParamValue($paramName, $value)
    {
        $this->getAccessor()
                        ->setValue($this->getData(), $paramName, $value);

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
}
