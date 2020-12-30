<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class BackstagePassItemStrategy extends AbstractItemStrategy
{
    use ItemStrategyActionsTrait;
    use ItemStrategyConditionalsTrait;

    protected function sellInPreDecrementTasks(Item $item): void
    {
        if ($this->isNotMaxQuality($item)) {
            $this->incrementQuality($item);

            if ($this->sellWithinDays($item, 11) && $this->isNotMaxQuality($item)) {
                $this->incrementQuality($item);
            }
            if ($this->sellWithinDays($item, 6) && $this->isNotMaxQuality($item)) {
                $this->incrementQuality($item);
            }
        }
    }

    protected function sellInPostDecrementTasks(Item $item): void
    {
        if ($this->isPastSellIn($item)) {
            $item->quality = 0;
        }
    }
}
