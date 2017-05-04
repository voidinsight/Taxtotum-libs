<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\AbstractTaxStrategy;

trait AbstractTaxStrategyTestTrait {
    
    /**
     * @dataProvider paramsDataProvider
     */
    public function testParamsAreSettable($param, $value) {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);;
        
        $this->assertInstanceOf(AbstractTaxStrategy::class, $sut);
        
        $this->assertSame($sut, $sut->setParamValue($param, $value));
        $this->assertSame($value, $sut->getParamValue($param));
    }
    
    public function paramsDataProvider() {
        return [
            ['test_param', 'test_value']
        ];
    }
}