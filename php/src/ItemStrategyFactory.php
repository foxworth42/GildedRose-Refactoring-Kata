<?php

namespace GildedRose;

use GildedRose\ItemStrategy\GenericItemStrategy;
use GildedRose\ItemStrategy\ItemStrategyInterface;
use GildedRose\ItemStrategyFactoryBits\AgedBrieThing;
use GildedRose\ItemStrategyFactoryBits\BackstagePassThing;
use GildedRose\ItemStrategyFactoryBits\ConjuredThing;
use GildedRose\ItemStrategyFactoryBits\GenericThing;
use GildedRose\ItemStrategyFactoryBits\SulfurasThing;

class ItemStrategyFactory
{
    public static function get(Item $item): ItemStrategyInterface
    {
        $thing = new AgedBrieThing(new BackstagePassThing(new SulfurasThing(new ConjuredThing(new GenericThing()))));
        return $thing->calculate($item);

        $strategies = [
            new AgedBrieThing(),
            new BackstagePassThing(),
            new SulfurasThing(),
            new ConjuredThing()
        ];

        foreach($strategies as $strategy) {
            if($strategy->isAThing($item)) {
                return $strategy->getStrategy();
            }
        }

        return new GenericItemStrategy();
    }
}
