<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\AbstractDecoratorTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

trait AbstractDecoratorTaxStrategyTestTrait {
    
    /**
     * @depends testParamsAreSettable
     */
    public function testDecoratedStrategyIsSettable() {
        $sut = $this->getMockForAbstractClass(AbstractDecoratorTaxStrategy::class);
        $strategy = $this->getMock(TaxStrategyInterface::class);
        
        $this->assertSame($sut, $sut->setDecoratedStrategy($strategy));
        $this->assertSame($strategy, $sut->getDecoratedStrategy());
    }
}