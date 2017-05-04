<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\TaxStrategy\FixedTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

class FixedTaxStrategyTest extends TestCase {
    
    private $obj;
    
    public function setUp() {
        $this->obj = $this->getMockBuilder(FixedTaxStrategy::class)
                                ->setMethods(null)
                                ->getMock();
    }
    
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculateReturnAlwaysDefinedValue($taxable, $value) {
        
        $this->obj->setParamValue(FixedTaxStrategy::PARAM_FIXED_VALUE, $value);
        
        $this->assertInstanceOf(TaxStrategyInterface::class, $this->obj);
        $this->assertSame($value, $this->obj->calculate($taxable));
        
    }
    
    public function calculateDataProvider() {
        return [
            [0.0, 5000.00],
            [10.0, 1.0],
            [1, 1000.98],
            [1000.999999, 0.0]
        ];
    }
}