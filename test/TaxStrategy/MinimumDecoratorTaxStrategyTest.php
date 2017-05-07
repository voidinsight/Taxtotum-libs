<?php

namespace VoidInsight\Taxtotum\Test\TaxStrategy;

use PHPUnit\Framework\TestCase;

class MinimumDecoratorTaxStrategyTest extends TestCase
{
    use AbstractTaxStrategyTestTrait;
    use AbstractDecoratorTaxStrategyTestTrait;
    use MinimumDecoratorTaxStrategyTestTrait;
}
