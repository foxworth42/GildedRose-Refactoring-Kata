<?php

namespace GildedRose\ItemStrategyFactoryBits;

use GildedRose\ItemStrategy\BackstagePassItemStrategy;
use GildedRose\ItemStrategy\ItemStrategyInterface;

class BackstagePassThing extends AbstractThing implements ThingInterface
{
    /** @var string */
    protected $itemName = 'Backstage passes to a TAFKAL80ETC concert';

    protected function getStrategy(): ItemStrategyInterface
    {
        return new BackstagePassItemStrategy();
    }
}