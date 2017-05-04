<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;

class RatioWithLimitTaxStrategyTest extends TestCase {
    
    use AbstractTaxStrategyTestTrait;
    use RatioTaxStrategyTestTrait;
    use RatioWithLimitTaxStrategyTestTrait;
    
}