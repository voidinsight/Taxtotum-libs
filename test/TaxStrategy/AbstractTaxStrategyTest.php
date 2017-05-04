<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\TaxStrategy\AbstractTaxStrategy;


class AbstractTaxStrategyTest extends TestCase {
    
    private $obj;
    
    public function setUp() {
        $this->obj = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
    }
    
    /**
     * @dataProvider paramsDataProvider
     */
    public function testParamsAreSettable($param, $value) {
        $this->assertInstanceOf(AbstractTaxStrategy::class, $this->obj);
        
        $this->assertSame($this->obj, $this->obj->setParamValue($param, $value));
        $this->assertSame($value, $this->obj->getParamValue($param));
    }
    
    public function paramsDataProvider() {
        return [
            ['test_param', 'test_value']
        ];
    }
}