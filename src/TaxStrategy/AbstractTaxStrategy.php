<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyDataInterface;
use VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException;
use VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\Exception\AccessException;


/**
 * Common ancestror for Strategies.
 *
 * An abstract implementation of Strategy pattern.
 */
abstract class AbstractTaxStrategy implements TaxStrategyInterface, TaxStrategyConfInterface
{
    /**
     * @internal
     * 
     * @var TaxStrategyDataInterface
     */
    private $params;

    /**
     * @return TaxStrategyDataInterface
     */
    public function getData() {
        $data = $this->params;
        
        if(!is_a($data, TaxStrategyDataInterface::class)) {
            throw new ItemNotSettedException('Data not setted');
        }
        
        return $data;
    }
    
    /**
     * @param TaxStrategyDataInterface $data
     * 
     * @return $this
     */
    public function setData(TaxStrategyDataInterface $data) {
        $this->params = $data;
        
        return $this;
    }

    /**
     * @internal
     * 
     * @var PropertyAccessorInterface
     */
    private $accessor;
    
    /**
     * @throw ItemNotSettedException
     * 
     * @return PropertyAccessorInterface
     */
    public function getAccessor() {
        $accessor = $this->accessor;
        
        if(!is_a($accessor, PropertyAccessorInterface::class)) {
            throw new ItemNotSettedException('Accessor not setted');
        }
        
        return $accessor;
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
    
    public function getParamValue($paramName)
    {
        try {
            $data = $this->getData();
            $accessor = $this->getAccessor();
            return $accessor->getValue($data, $paramName);
            
        } catch(AccessException $exception) {
            throw new ValueNotSettedException('Value not setted', 0, $exception);
            
        }
    }

    public function setParamValue($paramName, $value)
    {
        $data = $this->getData();
        $this->getAccessor()->setValue($data, $paramName, $value);

        return $this;
    }
    
    abstract public function calculate($taxable);
}
