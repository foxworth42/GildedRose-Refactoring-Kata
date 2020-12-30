<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class AgedBrieItemStrategy extends AbstractItemStrategy
{
    use ItemStrategyActionsTrait;
    use ItemStrategyConditionalsTrait;

    protected function sellInPreDecrementTasks(Item $item): void
    {
        if ($this->isNotMaxQuality($item)) {
            $this->incrementQuality($item);
        }
    }

    protected function sellInPostDecrementTasks(Item $item): void
    {
        if ($this->isPastSellIn($item) && $this->isNotMaxQuality($item)) {
            $this->incrementQuality($item);
        }
    }
}
