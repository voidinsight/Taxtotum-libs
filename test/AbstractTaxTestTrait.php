<?php

namespace VoidInsight\Taxtotum\Test;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use VoidInsight\Taxtotum\Libs\AbstractTax;
use VoidInsight\Taxtotum\Libs\TaxData\TaxData;
use VoidInsight\Taxtotum\Libs\TaxData\TaxDataInterface;

trait AbstractTaxTestTrait
{
    /**
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptionForAccessorNotSetted()
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);

        $sut->getAccessor();
    }

    /**
     * @depends testExceptionForAccessorNotSetted
     */
    public function testAccessorInterfaceIsSettable()
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);

        $accessor = $this->getMock(PropertyAccessorInterface::class);

        $this->assertSame($sut, $sut->setAccessor($accessor));
        $this->assertSame($accessor, $sut->getAccessor());
    }

     /**
      * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
      */
     public function testExceptionForDataNotSetted()
     {
         $sut = $this->getMockForAbstractClass(AbstractTax::class);

         $sut->getData();
     }

    /**
     * @depends testExceptionForDataNotSetted
     */
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
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException
     */
    public function testExceptionForParamValueNotSetted()
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);
        $sut->setData(new TaxData())->setAccessor(new PropertyAccessor());

        $sut->getParamValue('no_exists_param');
    }

    /**
     * @depends testAccessorInterfaceIsSettable
     * @depends testDataInterfaceIsSettable
     * @depends testExceptionForParamValueNotSetted
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
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testTaxableReturnADefaultValue()
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);
        $sut->setData(new TaxData())->setAccessor(new PropertyAccessor());

        $sut->getTaxable();
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
