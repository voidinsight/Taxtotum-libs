<?php
namespace VoidInsight\Taxtotum\Test;

use PHPUnit\Framework\TestCase;

use VoidInsight\Taxtotum\Libs\Tax;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;


class TaxTest extends TestCase {
    protected $obj;
    
    protected function setUp() {
        $this->obj = new Tax;
    }

    /**
     * @dataProvider calculateDataProvider
     **/
    public function testTaxIsCalculateUsingAStrategy($taxable, $tax) {
        
        //Create a mock for TaxStrategyInterface
        $strategy = $this->getMock(TaxStrategyInterface::class);
        $strategy->expects($this->once())
            ->method('calculate')
            ->will($this->returnValue($tax));
        
        //Create a mock for Tax to test
        $this->obj = $this->getMockBuilder(Tax::class)
                            ->setMethods(array('getStrategy', 'getTaxable'))
                            ->getMock();

        //Override getStrategy to return a strategy mocked                            
        $this->obj->expects($this->once())
            ->method('getStrategy')
            ->will($this->returnValue($strategy));
            
        //Override getTaxable to control value setted
        $this->obj->expects($this->once())
            ->method('getTaxable')
            ->will($this->returnValue($taxable));
            
        $this->assertInstanceOf(Tax::class, $this->obj);
        $this->assertSame($tax, $this->obj->calculate());
    }
    
    public function calculateDataProvider() {
        return [
            [0.0, 0.0],
            [10.0, 10.0],
            [100, 25]
        ];
    }
}