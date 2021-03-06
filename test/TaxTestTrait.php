<?php

namespace VoidInsight\Taxtotum\Test;

use VoidInsight\Taxtotum\Libs\Tax;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

use VoidInsight\Taxtotum\Libs\TaxData\TaxData;
use VoidInsight\Taxtotum\Libs\TaxData\TaxDataInterface;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

trait TaxTestTrait
{
    /**
     * @expectedException VoidInsight\Taxtotum\Libs\Exception\Logic\ItemNotSettedException
     */
    public function testExceptionForStrategyNotSetted() {
        $sut = $this->getMockBuilder(Tax::class)
                            ->setMethods(null)
                            ->getMock();
        $sut->setData(new TaxData)->setAccessor(new PropertyAccessor);
        
        $sut->getStrategy();
    }
    
    /**
     * @depends testParamsAreSettable
     * @depends testExceptionForStrategyNotSetted
     *
     * @dataProvider strategyDataProvider
     */
    public function testStrategyAttributeIsSettable(TaxStrategyInterface $strategy)
    {
        $sut = $this->getMockBuilder(Tax::class)
                            ->setMethods(null)
                            ->getMock();
        $sut->setData(new TaxData)->setAccessor(new PropertyAccessor);

        $this->assertSame($sut, $sut->setStrategy($strategy));
        $this->assertSame($strategy, $sut->getStrategy());
    }

    public function strategyDataProvider()
    {
        return [
            [$this->getMock(TaxStrategyInterface::class)],
        ];
    }

    /**
     * @depends testStrategyAttributeIsSettable
     *
     * @dataProvider calculateDataProvider
     **/
    public function testTaxIsCalculateUsingAStrategy($taxable, $tax)
    {
        //Create a mock for TaxStrategyInterface
        $strategy = $this->getMock(TaxStrategyInterface::class);
        $strategy->expects($this->once())
            ->method('calculate')
            ->will($this->returnValue($tax));

        //Create a mock for Tax to test
        $sut = $this->getMockBuilder(Tax::class)
                            ->setMethods(null)
                            ->getMock();
        $sut->setData(new TaxData)->setAccessor(new PropertyAccessor);
        $sut->setTaxable($taxable)->setStrategy($strategy);
        
        $this->assertSame($tax, $sut->calculate());
    }

    public function calculateDataProvider()
    {
        return [
            [0.0, 0.0],
            [10.0, 10.0],
            [100, 25],
        ];
    }
}
