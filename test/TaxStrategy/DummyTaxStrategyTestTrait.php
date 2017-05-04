<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\DummyTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

trait DummyTaxStrategyTestTrait {

    
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculateReturnAlwaysThePassedParam($taxable) {
        $sut = $this->getMockBuilder(DummyTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
                        
        $this->assertInstanceOf(TaxStrategyInterface::class, $sut);
        $this->assertSame($taxable, $sut->calculate($taxable));
        
    }
    
    public function calculateDataProvider() {
        return [
            [0.0],
            [10.0],
            [1],
            [1000.999999]
        ];
    }
}