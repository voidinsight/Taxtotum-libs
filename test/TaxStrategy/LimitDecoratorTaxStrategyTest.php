<?php
namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;


class LimitDecoratorTaxStrategyTest extends TestCase {
    
    use AbstractTaxStrategyTestTrait;
    use AbstractDecoratorTaxStrategyTestTrait;
    use LimitDecoratorTaxStrategyTestTrait;
}