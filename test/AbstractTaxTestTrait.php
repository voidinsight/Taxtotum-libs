<?php

namespace VoidInsight\Taxtotum\Test;

use VoidInsight\Taxtotum\Libs\AbstractTax;
use VoidInsight\Taxtotum\Libs\TaxConfInterface;

trait AbstractTaxTestTrait
{
    /**
     * @dataProvider paramsDataProvider
     */
    public function testParamsAreSettable($param, $value)
    {
        $sut = $this->getMockForAbstractClass(AbstractTax::class);

        $this->assertInstanceOf(TaxConfInterface::class, $sut);

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
