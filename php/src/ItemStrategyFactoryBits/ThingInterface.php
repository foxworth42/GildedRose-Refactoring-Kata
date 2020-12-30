<?php

namespace GildedRose\ItemStrategyFactoryBits;

use GildedRose\Item;
use GildedRose\ItemStrategy\ItemStrategyInterface;

interface ThingInterface
{
    public function calculate(Item $item): ItemStrategyInterface;
}