<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\FixedTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

trait FixedTaxStrategyTestTrait
{
    /**
     * @depends testParamsAreSettable
     *
     * @dataProvider fixedtaxDataProvider
     */
    public function testFixedTaxValueIsSettable($value)
    {
        $sut = $this->getMockBuilder(FixedTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();

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
