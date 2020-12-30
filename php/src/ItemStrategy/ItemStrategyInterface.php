<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

interface ItemStrategyInterface
{
    public function calculateInventory(Item $item);
}
