<?php

namespace GildedRose\ItemStrategyFactoryBits;

use GildedRose\ItemStrategy\ItemStrategyInterface;
use GildedRose\ItemStrategy\SulfurasItemStrategy;

class SulfurasThing extends AbstractThing implements ThingInterface
{
    /** @var string */
    protected $itemName = 'Sulfuras, Hand of Ragnaros';

    protected function getStrategy(): ItemStrategyInterface
    {
        return new SulfurasItemStrategy();
    }
}