<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\MinimumDecoratorTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

trait MinimumDecoratorTaxStrategyTestTrait {
    
    /**
     * @depends testDecoratedStrategyIsSettable
     * 
     * @dataProvider taxminimumDataProvider
     */
    public function testTaxMinimumIsSettable($minimum) {
        $sut = $this->getMockBuilder(MinimumDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        
        $this->assertSame($sut, $sut->setTaxMinimum($minimum));
        $this->assertSame($minimum, $sut->getTaxMinimum());
    }
    
    public function taxminimumDataProvider() {
        return [
            [0.0], [1000.99], [12.00]
        ];
    }
    
    /**
     * @depends testTaxMinimumIsSettable
     * @depends testDecoratedStrategyIsSettable
     * 
     * @dataProvider minimumCalculateDataProvider
     */
    public function testCalculateApplyADefinedMinimumToTheValue($taxable, $minimum, $value) {
        $strategy = $this->getMock(TaxStrategyInterface::class);
        $strategy->expects($this->once())
                    ->method('calculate')
                        ->with($this->equalTo($taxable))
                    ->will($this->returnValue($taxable));
                    
        $sut = $this->getMockBuilder(MinimumDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setDecoratedStrategy($strategy);
        $sut->setTaxMinimum($minimum);
                
        $this->assertSame($value, $sut->calculate($taxable));
    }
    
    public function minimumCalculateDataProvider() {
        return [
            [1000.00,  500.00, 1000.00],
            [1000.00, 2000.00, 2000.00]
        ];
    }
}