<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;

class MaximumDecoratorTaxStrategyTest extends TestCase
{
    use AbstractTaxStrategyTestTrait;
    use AbstractDecoratorTaxStrategyTestTrait;
    use MaximumDecoratorTaxStrategyTestTrait;
}
