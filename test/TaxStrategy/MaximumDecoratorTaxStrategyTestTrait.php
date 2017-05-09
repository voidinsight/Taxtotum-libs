<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\MaximumDecoratorTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use Symfony\Component\PropertyAccess\PropertyAccessor;

trait MaximumDecoratorTaxStrategyTestTrait
{
    /**
     * @depends testDecoratedStrategyIsSettable
     *
     * @dataProvider taxmaximumDataProvider
     */
    public function testTaxMaximumIsSettable($maximum)
    {
        $sut = $this->getMockBuilder(MaximumDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $this->assertSame($sut, $sut->setTaxMaximum($maximum));
        $this->assertSame($maximum, $sut->getTaxMaximum());
    }

    public function taxmaximumDataProvider()
    {
        return [
            [0.0], [1000.99], [12.00],
        ];
    }

    /**
     * @depends testTaxMaximumIsSettable
     * @depends testDecoratedStrategyIsSettable
     *
     * @dataProvider maximumCalculateDataProvider
     */
    public function testCalculateApplyADefinedMaximumToTheValue($taxable, $maximum, $value)
    {
        $strategy = $this->getMock(TaxStrategyInterface::class);
        $strategy->expects($this->once())
                    ->method('calculate')
                        ->with($this->equalTo($taxable))
                    ->will($this->returnValue($taxable));

        $sut = $this->getMockBuilder(MaximumDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());
        $sut->setDecoratedStrategy($strategy);
        $sut->setTaxMaximum($maximum);

        $this->assertSame($value, $sut->calculate($taxable));
    }

    public function maximumCalculateDataProvider()
    {
        return [
            [1000.00, 500.00, 500.00],
            [1000.00, 2000.00, 1000.00],
            [1000.00, 1000.00, 1000.00],
        ];
    }
}
