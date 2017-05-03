<?php
namespace VoidInsight\Taxtotum\Test;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\AbstractTax;
use VoidInsight\Taxtotum\Libs\TaxInterface;

class AbstractTaxTest extends TestCase {
    
    protected $obj;
    
    protected function setUp() {
        $this->obj = $this->getMockForAbstractClass(AbstractTax::class);
    }
    
    /**
     * @dataProvider taxableDataProvider
     **/
    public function testTaxableAttributeIsSettable($taxable) {
        
        $this->assertInstanceOf(AbstractTax::class, $this->obj);
        
        $this->assertSame($this->obj, $this->obj->setTaxable($taxable));
        
        $this->assertSame($taxable,
                $this->obj->getTaxable());
    }
    
    public function taxableDataProvider() {
        return [
            [0.0],
            [10.0],
            [100000.99]
        ];
    }
}