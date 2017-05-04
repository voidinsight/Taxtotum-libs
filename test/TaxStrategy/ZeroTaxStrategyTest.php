<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\TaxStrategy\ZeroTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

class ZeroTaxStrategyTest extends TestCase {
    
    private $obj;
    
    public function setUp() {
        $this->obj = new ZeroTaxStrategy;
    }
    
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculateReturnAlwaysZero($taxable) {
        
        $this->assertInstanceOf(TaxStrategyInterface::class, $this->obj);
        $this->assertSame(0.0, $this->obj->calculate($taxable));
        
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