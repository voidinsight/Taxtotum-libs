<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\AbstractDecoratorTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use Symfony\Component\PropertyAccess\PropertyAccessor;

trait AbstractDecoratorTaxStrategyTestTrait
{
    /**
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptioForDecoratedStrategyNotSetted() {
        $sut = $this->getMockForAbstractClass(AbstractDecoratorTaxStrategy::class);
        $sut->setData(new TaxStrategyData)->setAccessor(new PropertyAccessor);
        
        $sut->getDecoratedStrategy();
    }
    
    /**
     * @depends testParamsAreSettable
     * @depends testExceptioForDecoratedStrategyNotSetted
     */
    public function testDecoratedStrategyIsSettable()
    {
        $sut = $this->getMockForAbstractClass(AbstractDecoratorTaxStrategy::class);
        $sut->setData(new TaxStrategyData)->setAccessor(new PropertyAccessor);
        
        $strategy = $this->getMock(TaxStrategyInterface::class);

        $this->assertSame($sut, $sut->setDecoratedStrategy($strategy));
        $this->assertSame($strategy, $sut->getDecoratedStrategy());
    }
}
