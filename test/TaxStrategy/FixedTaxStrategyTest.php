<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;
use VoidInsight\Taxtotum\Libs\TaxStrategy\FixedTaxStrategy;
use VoidInsight\Taxtotum\Libs\TaxStrategy\TaxStrategyInterface;

class FixedTaxStrategyTest extends TestCase {
    
    use AbstractTaxStrategyTestTrait;
    use FixedTaxStrategyTestTrait;
}