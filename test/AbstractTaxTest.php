<?php
namespace VoidInsight\Taxtotum\Test;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\AbstractTax;
use VoidInsight\Taxtotum\Libs\TaxInterface;
use VoidInsight\Taxtotum\Libs\TaxConfInterface;

class AbstractTaxTest extends TestCase {
    
    protected $obj;
    
    protected function setUp() {
        $this->obj = $this->getMockForAbstractClass(AbstractTax::class);
    }
    
    /**
     * @dataProvider paramsDataProvider
     */
    public function testParamsAreSettable($param, $value) {
        $this->assertInstanceOf(TaxConfInterface::class, $this->obj);
        
        $this->assertSame($this->obj, $this->obj->setParamValue($param, $value));
        $this->assertSame($value, $this->obj->getParamValue($param));
    }
    
    public function paramsDataProvider() {
        return [
            ['test_param', 'test_value']
        ];
    }
    
    /**
     * @dataProvider taxableDataProvider
     * @depends testParamsAreSettable
     */
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