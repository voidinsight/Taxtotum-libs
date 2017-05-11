<?php

namespace VoidInsight\Taxtotum\Libs;

use VoidInsight\Taxtotum\Libs\TaxData\TaxDataInterface;
use VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException;
use VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\Exception\AccessException;

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
    public function getAccessor()
    {
        $accessor = $this->accessor;

        if (!is_a($accessor, PropertyAccessorInterface::class)) {
            throw new ItemNotSettedException('Accessor not setted');
        }

        return $accessor;
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

    /**
     * @internal
     *
     * @var TaxDataInterface
     */
    private $params;

    /**
     * @return TaxDataInterface
     */
    public function getData()
    {
        $data = $this->params;

        if (!is_a($data, TaxDataInterface::class)) {
            throw new ItemNotSettedException('Data not setted');
        }

        return $data;
    }

    /**
     * @param TaxDataInterface $taxData
     *
     * @return $this
     */
    public function setData(TaxDataInterface $taxData)
    {
        $this->params = $taxData;

        return $this;
    }

    public function getParamValue($paramName)
    {
        try {
            $data = $this->getData();
            $accessor = $this->getAccessor();

            return $accessor->getValue($data, $paramName);
        } catch (AccessException $exception) {
            throw new ValueNotSettedException(
                'Value not setted', 0, $exception);
        }
    }

    public function setParamValue($paramName, $value)
    {
        $data = $this->getData();
        $this->getAccessor()->setValue($data, $paramName, $value);

        return $this;
    }

    public function getTaxable()
    {
        try {
            return $this->getParamValue(self::PARAM_TAXABLE);
        } catch (ValueNotSettedException $exception) {
            throw new ItemNotSettedException(
                'No taxable amount setted', 0, $exception);
        }
    }

    public function setTaxable($taxable)
    {
        $this->setParamValue(self::PARAM_TAXABLE, $taxable);

        return $this;
    }

    abstract public function calculate();
}
