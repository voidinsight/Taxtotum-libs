<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\LimitDecoratorTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

trait LimitDecoratorTaxStrategyTestTrait {
    
    /**
     * @depends testDecoratedStrategyIsSettable
     * 
     * @dataProvider taxlimitDataProvider
     */
    public function testTaxLimitIsSettable($limit) {
        $sut = $this->getMockBuilder(LimitDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        
        $this->assertSame($sut, $sut->setTaxLimit($limit));
        $this->assertSame($limit, $sut->getTaxLimit());
    }
    
    public function taxlimitDataProvider() {
        return [
            [0.0], [1000.99], [12.00]
        ];
    }
    
    /**
     * @depends testTaxLimitIsSettable
     * @depends testDecoratedStrategyIsSettable
     * 
     * @dataProvider limitedCalculateDataProvider
     */
    public function testCalculateApplyADefinedLimitToTheValue($taxable, $limit, $value) {
        $strategy = $this->getMock(TaxStrategyInterface::class);
        $strategy->expects($this->once())
                    ->method('calculate')
                        ->with($this->equalTo($taxable))
                    ->will($this->returnValue($taxable));
                    
        $sut = $this->getMockBuilder(LimitDecoratorTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
        $sut->setDecoratedStrategy($strategy);
        $sut->setTaxLimit($limit);
                
        $this->assertSame($value, $sut->calculate($taxable));
    }
    
    public function limitedCalculateDataProvider() {
        return [
            [1000.00, 500.00, 500.00],
            [1000.00, 2000.00, 1000.00],
            [1000.00, 1000.00, 1000.00]
        ];
    }
}