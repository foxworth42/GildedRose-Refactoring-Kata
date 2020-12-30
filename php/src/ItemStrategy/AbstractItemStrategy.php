<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

abstract class AbstractItemStrategy implements ItemStrategyInterface
{
    use ItemStrategyActionsTrait;

    public function calculateInventory(Item $item): void
    {
        $this->sellInPreDecrementTasks($item);
        $this->sellInDecrementTasks($item);
        $this->sellInPostDecrementTasks($item);
    }

    protected function sellInDecrementTasks(Item $item): void
    {
        $this->decrementSellIn($item);
    }

    abstract protected function sellInPreDecrementTasks(Item $item): void;

    abstract protected function sellInPostDecrementTasks(Item $item): void;
}
