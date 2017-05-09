<?php

namespace VoidInsight\Taxtotum\Test;

use VoidInsight\Taxtotum\Libs\AbstractTax;
use VoidInsight\Taxtotum\Libs\TaxData\TaxDataInterface;
use VoidInsight\Taxtotum\Libs\TaxData\TaxData;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;

trait AbstractTaxTestTrait
{
    public function testAccessorInterfaceIsSettable()
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);

        $accessor = $this->getMock(PropertyAccessorInterface::class);

        $this->assertSame($sut, $sut->setAccessor($accessor));
        $this->assertSame($accessor, $sut->getAccessor());
    }

    public function testDataInterfaceIsSettable()
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);

        $data = $this->getMock(TaxDataInterface::class);

        $this->assertSame($sut, $sut->setData($data));
        $this->assertSame($data, $sut->getData());
    }

    /**
     * @depends testAccessorInterfaceIsSettable
     * @depends testDataInterfaceIsSettable
     *
     * @dataProvider paramsDataProvider
     */
    public function testParamsAreSettable($param, $value)
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);
        $sut->setData(new TaxData())->setAccessor(new PropertyAccessor());

        $this->assertSame($sut, $sut->setParamValue($param, $value));
        $this->assertSame($value, $sut->getParamValue($param));
    }

    public function paramsDataProvider()
    {
        return [
            ['test_param', 'test_value'],
        ];
    }

    /**
     * @depends testParamsAreSettable
     *
     * @dataProvider taxableDataProvider
     */
    public function testTaxableAttributeIsSettable($taxable)
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);
        $sut->setData(new TaxData())->setAccessor(new PropertyAccessor());

        $this->assertSame($sut, $sut->setTaxable($taxable));
        $this->assertSame($taxable, $sut->getTaxable());
    }

    public function taxableDataProvider()
    {
        return [
            [0.0],
            [10.0],
            [100000.99],
        ];
    }
}
