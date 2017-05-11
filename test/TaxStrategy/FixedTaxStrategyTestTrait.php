<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\FixedTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use Symfony\Component\PropertyAccess\PropertyAccessor;

trait FixedTaxStrategyTestTrait
{
    /**
     * @depends testDataIsSettable
     * @depends testAccessorIsSettable
     *
     * @expectedException \VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptionForFixedTaxValueNotSetted()
    {
        $sut = $this->getMockBuilder(FixedTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $sut->getFixedTax();
    }

    /**
     * @depends testDataIsSettable
     * @depends testAccessorIsSettable
     * @depends testParamsAreSettable
     * @depends testExceptionForFixedTaxValueNotSetted
     *
     * @dataProvider fixedtaxDataProvider
     */
    public function testFixedTaxValueIsSettable($value)
    {
        $sut = $this->getMockBuilder(FixedTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $this->assertSame($sut, $sut->setFixedTax($value));
        $this->assertSame($value, $sut->getFixedTax());
    }

    public function fixedtaxDataProvider()
    {
        return [
            [0.0], [59.00], [10000.99],
        ];
    }

    /**
     * @depends testFixedTaxValueIsSettable
     *
     * @dataProvider calculateDataProvider
     */
    public function testCalculateReturnAlwaysDefinedValue($taxable, $value)
    {
        $sut = $this->getMockBuilder(FixedTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $sut->setFixedTax($value);

        $this->assertInstanceOf(TaxStrategyInterface::class, $sut);
        $this->assertSame($value, $sut->calculate($taxable));
    }

    public function calculateDataProvider()
    {
        return [
            [0.0, 5000.00],
            [10.0, 1.0],
            [1, 1000.98],
            [1000.999999, 0.0],
        ];
    }
}
