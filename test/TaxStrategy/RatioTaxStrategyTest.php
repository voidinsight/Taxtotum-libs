<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\TaxStrategy\RatioTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

class RatioTaxStrategyTest extends TestCase {
    
    private $obj;
    
    public function setUp() {
        $this->obj = $this->getMockBuilder(RatioTaxStrategy::class)
                                ->setMethods(null)
                                ->getMock();
    }
    
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculateAValueBasedOnRatioDefined($taxable, $ratio, $value) {
        
        $this->obj->setParamValue(RatioTaxStrategy::PARAM_RATIO_VALUE, $ratio);
        
        $this->assertInstanceOf(TaxStrategyInterface::class, $this->obj);
        $this->assertSame($value, $this->obj->calculate($taxable));
        
    }
    
    public function calculateDataProvider() {
        return [
            [100, 0.25, 25.00],
            [500, 0.5, 250.00],
            [0.0, 1.0, 0.0]
        ];
    }
}