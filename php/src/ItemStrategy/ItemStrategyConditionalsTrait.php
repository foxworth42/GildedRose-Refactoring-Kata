<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

trait ItemStrategyConditionalsTrait
{
    private function isNotMaxQuality(Item $item): bool
    {
        return $item->quality < 50;
    }

    private function isPastSellIn(Item $item): bool
    {
        return $item->sell_in < 0;
    }

    private function hasQualityLeft(Item $item): bool
    {
        return $item->quality > 0;
    }

    private function sellWithinDays(Item $item, int $days): bool
    {
        return $item->sell_in < $days;
    }

    protected function hasNegativeQuality(Item $item): bool
    {
        return $item->quality < 0;
    }
}
