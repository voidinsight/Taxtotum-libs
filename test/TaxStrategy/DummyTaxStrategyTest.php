<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\TaxStrategy\DummyTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

class DummyTaxStrategyTest extends TestCase {
    
    private $obj;
    
    public function setUp() {
        $this->obj = new DummyTaxStrategy;
    }
    
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculateReturnAlwaysThePassedParam($taxable) {
        
        $this->assertInstanceOf(TaxStrategyInterface::class, $this->obj);
        $this->assertSame($taxable, $this->obj->calculate($taxable));
        
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