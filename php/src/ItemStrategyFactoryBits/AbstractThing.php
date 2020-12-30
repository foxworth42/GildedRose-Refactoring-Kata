<?php


namespace GildedRose\ItemStrategyFactoryBits;


use GildedRose\Item;
use GildedRose\ItemStrategy\ItemStrategyInterface;

abstract class AbstractThing
{
    /**
     * @var ThingInterface
     */
    protected $nextThing;

    /** @var string */
    protected $itemName;

    public function __construct(ThingInterface $nextThing)
    {

        $this->nextThing = $nextThing;
    }

    protected function isAThing(Item $item): bool
    {
        return $item->name == $this->itemName;
    }

    public function calculate(Item $item): ItemStrategyInterface
    {
        if ($this->isAThing($item)) {
            return $this->getStrategy();
        }

        return $this->nextThing->calculate($item);
    }
}