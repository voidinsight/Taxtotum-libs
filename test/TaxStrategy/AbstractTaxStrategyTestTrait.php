<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\AbstractTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyDataInterface;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;

trait AbstractTaxStrategyTestTrait
{
    public function testAccessorIsSettable() {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
        $accessor = $this->getMock(PropertyAccessorInterface::class);
        
        $this->assertSame($sut, $sut->setAccessor($accessor));
        $this->assertSame($accessor, $sut->getAccessor());
    }
    
    public function testDataIsSettable() {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
        $data = $this->getMock(TaxStrategyDataInterface::class);
        
        $this->assertSame($sut, $sut->setData($data));
        $this->assertSame($data, $sut->getData());
    }
    
    /**
     * @depends testAccessorIsSettable
     * @depends testDataIsSettable
     * 
     * @dataProvider paramsDataProvider
     */
    public function testParamsAreSettable($param, $value)
    {
        $sut = $this->getMockForAbstractClass(AbstractTaxStrategy::class);
        $sut->setData(new TaxStrategyData)->setAccessor(new PropertyAccessor);

        $this->assertSame($sut, $sut->setParamValue($param, $value));
        $this->assertSame($value, $sut->getParamValue($param));
    }

    public function paramsDataProvider()
    {
        return [
            ['test_param', 'test_value'],
        ];
    }
}
