<?php

namespace VoidInsight\Taxtotum\Libs;

/**
 * Global Interface.
 *
 * The main interface to define a Tax
 *
 * @authtor Alberto Clemente
 */
interface TaxInterface
{
    /**
     * Access to Taxable Attribute.
     *
     * An accessor method to read Taxable Attribute value
     * 
     * 
     * @return float
     */
    public function getTaxable();

    /**
     * Access to Taxable Attribute.
     *
     * An accessor method to write Taxable Attribute value
     *
     * @param float $taxable
     *
     * @return $this
     */
    public function setTaxable($taxable);

    /**
     * Calculate tax.
     *
     * Compute the tax value on taxable amount setted
     *
     * @return float
     */
    public function calculate();
}
