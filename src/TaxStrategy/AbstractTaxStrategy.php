<?php

namespace VoidInsight\Taxtotum\Libs\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyDataInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

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

    /**
     * @return TaxStrategyDataInterface
     */
    public function getData()
    {
        return $this->params;
    }

    /**
     * @param TaxStrategyDataInterface $data
     *
     * @return $this
     */
    public function setData(TaxStrategyDataInterface $data)
    {
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
     * @return PropertyAccessorInterface
     */
    public function getAccessor()
    {
        return $this->accessor;
    }

    /**
     * @param PropertyAccessorInterface $accessor
     *
     * @return $this
     */
    public function setAccessor(PropertyAccessorInterface $accessor)
    {
        $this->accessor = $accessor;

        return $this;
    }

    public function getParamValue($paramName)
    {
        $data = $this->getData();

        return $this->getAccessor()->getValue($data, $paramName);
    }

    public function setParamValue($paramName, $value)
    {
        $data = $this->getData();
        $this->getAccessor()->setValue($data, $paramName, $value);

        return $this;
    }

    abstract public function calculate($taxable);
}
