<?php

namespace GildedRose\ItemStrategyFactoryBits;

use GildedRose\Item;
use GildedRose\ItemStrategy\ConjuredItemStrategy;
use GildedRose\ItemStrategy\ItemStrategyInterface;

class ConjuredThing extends AbstractThing implements ThingInterface
{
    protected function isAThing(Item $item): bool
    {
        return $this->isConjuredItem($item);
    }

    protected function getStrategy(): ItemStrategyInterface
    {
        return new ConjuredItemStrategy();
    }

    private function isConjuredItem(Item $item): bool
    {
        return strpos(strtolower($item->name), 'conjured') !== false;
    }
}