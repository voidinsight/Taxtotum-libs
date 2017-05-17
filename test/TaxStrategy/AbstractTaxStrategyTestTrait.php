<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use VoidInsight\Taxtotum\Libs\TaxStrategy\AbstractTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyDataInterface;

trait AbstractTaxStrategyTestTrait
{
    /**
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptionForAccessorNotSetted()
    {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);

        $sut->getAccessor();
    }

    /**
     * @depends testExceptionForAccessorNotSetted
     */
    public function testAccessorIsSettable()
    {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
        $accessor = $this->getMock(PropertyAccessorInterface::class);

        $this->assertSame($sut, $sut->setAccessor($accessor));
        $this->assertSame($accessor, $sut->getAccessor());
    }

    /**
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptionForDataNotSetted()
    {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);

        $sut->getData();
    }

    /**
     * @depends testExceptionForDataNotSetted
     */
    public function testDataIsSettable()
    {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
        $data = $this->getMock(TaxStrategyDataInterface::class);

        $this->assertSame($sut, $sut->setData($data));
        $this->assertSame($data, $sut->getData());
    }

    /**
     * @depends testDataIsSettable
     * @depends testAccessorIsSettable
     *
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Runtime\ValueNotSettedException
     */
    public function testExceptionForParamValueNotSetted()
    {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $sut->getParamValue('no_exists_param');
    }

    /**
     * @depends testAccessorIsSettable
     * @depends testDataIsSettable
     * @depends testExceptionForParamValueNotSetted
     *
     * @dataProvider paramsDataProvider
     */
    public function testParamsAreSettable($param, $value)
    {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $this->assertSame($sut, $sut->setParamValue($param, $value));
        $this->assertSame($value, $sut->getParamValue($param));
    }

    public function paramsDataProvider()
    {
        return [
            ['test_param', 'test_value'],
        ];
    }
}
