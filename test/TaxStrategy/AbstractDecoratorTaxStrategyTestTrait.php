<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use VoidInsight\Taxtotum\Libs\TaxStrategy\AbstractDecoratorTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyData\TaxStrategyData;
use Symfony\Component\PropertyAccess\PropertyAccessor;

trait AbstractDecoratorTaxStrategyTestTrait
{
    /**
     * @depends testParamsAreSettable
     */
    public function testDecoratedStrategyIsSettable()
    {
        $sut = $this->getMockForAbstractClass(AbstractDecoratorTaxStrategy::class);
        $sut->setData(new TaxStrategyData())->setAccessor(new PropertyAccessor());

        $strategy = $this->getMock(TaxStrategyInterface::class);

        $this->assertSame($sut, $sut->setDecoratedStrategy($strategy));
        $this->assertSame($strategy, $sut->getDecoratedStrategy());
    }
}
