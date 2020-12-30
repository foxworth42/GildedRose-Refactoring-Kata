<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class SulfurasItemStrategy implements ItemStrategyInterface
{
    use ItemStrategyActionsTrait;

    public function calculateInventory(Item $item): void
    {
    }
}
