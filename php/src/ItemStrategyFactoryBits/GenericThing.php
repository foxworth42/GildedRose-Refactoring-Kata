<?php

namespace GildedRose\ItemStrategyFactoryBits;

use GildedRose\Item;
use GildedRose\ItemStrategy\GenericItemStrategy;
use GildedRose\ItemStrategy\ItemStrategyInterface;

class GenericThing implements ThingInterface
{
    public function calculate(Item $item): ItemStrategyInterface
    {
        return new GenericItemStrategy();
    }
}