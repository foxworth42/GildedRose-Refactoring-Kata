<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

trait ItemStrategyActionsTrait
{
    private function decrementSellIn(Item $item): void
    {
        $item->sell_in = $item->sell_in - 1;
    }

    private function incrementQuality(Item $item): void
    {
        $item->quality = $item->quality + 1;
    }

    private function decrementQuality(Item $item, int $decrementBy = 1): void
    {
        $item->quality = $item->quality - $decrementBy;
    }
}
