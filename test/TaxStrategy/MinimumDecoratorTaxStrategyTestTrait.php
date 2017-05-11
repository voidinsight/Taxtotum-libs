<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\MinimumDecoratorTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use Symfony\Component\PropertyAccess\PropertyAccessor;

trait MinimumDecoratorTaxStrategyTestTrait
{
    /**
     * @depends testDataIsSettable
     * @depends testAccessorIsSettable
     * 
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptionForTaxMinimumNotSetted() {
        $sut = $this->getMockBuilder(MinimumDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData)->setAccessor(new PropertyAccessor);
        
        $sut->getTaxMinimum();
    }
    
    /**
     * @depends testDecoratedStrategyIsSettable
     * @depends testExceptionForTaxMinimumNotSetted
     * 
     * @dataProvider taxminimumDataProvider
     */
    public function testTaxMinimumIsSettable($minimum)
    {
        $sut = $this->getMockBuilder(MinimumDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData)->setAccessor(new PropertyAccessor);
        
        $this->assertSame($sut, $sut->setTaxMinimum($minimum));
        $this->assertSame($minimum, $sut->getTaxMinimum());
    }

    public function taxminimumDataProvider()
    {
        return [
            [0.0], [1000.99], [12.00],
        ];
    }

    /**
     * @depends testTaxMinimumIsSettable
     * @depends testDecoratedStrategyIsSettable
     *
     * @dataProvider minimumCalculateDataProvider
     */
    public function testCalculateApplyADefinedMinimumToTheValue($taxable, $minimum, $value)
    {
        $strategy = $this->getMock(TaxStrategyInterface::class);
        $strategy->expects($this->once())
                    ->method('calculate')
                        ->with($this->equalTo($taxable))
                    ->will($this->returnValue($taxable));

        $sut = $this->getMockBuilder(MinimumDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setData(new TaxStrategyData)->setAccessor(new PropertyAccessor);
        $sut->setDecoratedStrategy($strategy);
        $sut->setTaxMinimum($minimum);

        $this->assertSame($value, $sut->calculate($taxable));
    }

    public function minimumCalculateDataProvider()
    {
        return [
            [1000.00,  500.00, 1000.00],
            [1000.00, 2000.00, 2000.00],
        ];
    }
}
