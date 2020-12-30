<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class ConjuredItemStrategy extends AbstractItemStrategy
{
    use ItemStrategyActionsTrait;
    use ItemStrategyConditionalsTrait;

    protected function sellInPreDecrementTasks(Item $item): void
    {
        if ($this->hasQualityLeft($item)) {
            $this->decrementQuality($item, 2);
        }
    }

    protected function sellInPostDecrementTasks(Item $item): void
    {
        if ($this->isPastSellIn($item) && $this->hasQualityLeft($item)) {
            $this->decrementQuality($item, 2);
        }

        if($this->hasNegativeQuality($item)) {
            $item->quality = 0;
        }
    }
}
