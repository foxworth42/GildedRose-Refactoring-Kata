<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class GenericItemStrategy extends AbstractItemStrategy
{
    use ItemStrategyActionsTrait;
    use ItemStrategyConditionalsTrait;

    protected function sellInPreDecrementTasks(Item $item): void
    {
        if ($this->hasQualityLeft($item)) {
            $this->decrementQuality($item);
        }
    }

    protected function sellInPostDecrementTasks(Item $item): void
    {
        if ($this->isPastSellIn($item) && $this->hasQualityLeft($item)) {
            $this->decrementQuality($item);
        }
    }
}
