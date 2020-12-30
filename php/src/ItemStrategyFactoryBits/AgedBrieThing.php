<?php


namespace GildedRose\ItemStrategyFactoryBits;


use GildedRose\ItemStrategy\AgedBrieItemStrategy;
use GildedRose\ItemStrategy\ItemStrategyInterface;

class AgedBrieThing extends AbstractThing implements ThingInterface
{
    /** @var string */
    protected $itemName = 'Aged Brie';

    protected function getStrategy(): ItemStrategyInterface
    {
        return new AgedBrieItemStrategy();
    }
}