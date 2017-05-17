<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use VoidInsight\Taxtotum\Libs\TaxStrategy\RatioTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

trait RatioTaxStrategyTestTrait
{
    /**
     * @depends testDataIsSettable
     * @depends testAccessorIsSettable
     *
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptionForRatioValueNotSetted()
    {
        $sut = $this->getMockBuilder(RatioTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $sut->getRatioValue();
    }

    /**
     * @depends testParamsAreSettable
     * @depends testExceptionForRatioValueNotSetted
     *
     * @dataProvider ratioDataProvider
     */
    public function testRatioValueIsSettable($ratio)
    {
        $sut = $this->getMockBuilder(RatioTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $this->assertInstanceOf(RatioTaxStrategy::class, $sut);
        $this->assertSame($sut, $sut->setRatioValue($ratio));
        $this->assertSame($ratio, $sut->getRatioValue());
    }

    public function ratioDataProvider()
    {
        return [
            [.0], [.25], [.5], [1.0],
        ];
    }

    /**
     * @depends testRatioValueIsSettable
     * @dataProvider calculateRatioDataProvider
     */
    public function testCalculateAValueBasedOnRatioDefined($taxable, $ratio, $value)
    {
        $sut = $this->getMockBuilder(RatioTaxStrategy::class)
                                        ->setMethods(null)
                                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());
        $sut->setRatioValue($ratio);

        $this->assertInstanceOf(TaxStrategyInterface::class, $sut);
        $this->assertSame($value, $sut->calculate($taxable));
    }

    public function calculateRatioDataProvider()
    {
        return [
            [100, 0.25, 25.00],
            [500, 0.5, 250.00],
            [0.0, 1.0, 0.0],
        ];
    }
}
