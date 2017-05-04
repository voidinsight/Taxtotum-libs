<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\RatioWithLimitTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

trait RatioWithLimitTaxStrategyTestTrait {
    
    /**
     * @depends testParamsAreSettable
     * 
     * @dataProvider taxlimitDataProvider
     */
    public function testTaxLimitValueIsSettable($limit) {
        $sut = $this->getMockBuilder(RatioWithLimitTaxStrategy::class)
                        ->setMethods(null)
                        ->getMock();
                        
        $this->assertInstanceOf(RatioWithLimitTaxStrategy::class, $sut);
        $this->assertSame($sut, $sut->setTaxLimitValue($limit));
        $this->assertSame($limit, $sut->getTaxLimitValue());
    }
    
    public function taxlimitDataProvider() {
        return [
            [100], [1999.99], [99999.99], [0.0]
        ];
    }
    
    /**
     * @depends testTaxLimitValueIsSettable
     * @depends testRatioValueIsSettable
     * @depends testCalculateAValueBasedOnRatioDefined
     * 
     * @dataProvider calculateRatioLimitDataProvider
     */
    public function testCalculateRatioWithLimit($taxable, $ratio, $limit, $value) {
        $sut = $this->getMockBuilder(RatioWithLimitTaxStrategy::class)
                                        ->setMethods(null)
                                        ->getMock();
                                
        $sut->setTaxLimitValue($limit)
            ->setRatioValue($ratio);
        
        $this->assertSame($value, $sut->calculate($taxable));
    }
    
    public function calculateRatioLimitDataProvider() {
        return [
            [1000.00, .50, 250.00, 250.00],
            [1000.00, .10, 250.00, 100.00],
            [1000.00, 1.0, 0.0, 0.0]
        ];
    }
}