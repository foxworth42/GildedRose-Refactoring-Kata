<?php

declare(strict_types=1);

namespace Tests;

//use GildedRose\GildedRoseOriginal as GildedRose;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /** @test */
    public function shouldStillHaveNoItemsIfInitializedWithNoItems(): void
    {
        $items = [];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, count($items));
    }

    /** @test */
    public function shouldDecreaseQualityBy2AfterSellBy(): void
    {
        // Arrange
        $items = [new Item('foo', 0, 5)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
    }

    /** @test */
    public function shouldNeverDecraseQualityBelow0(): void
    {
        // Arrange
        $items = [new Item('foo', 1, 0)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    /** @test */
    public function shouldIncreaseValueForAgedBrie(): void
    {
        // Arrange
        $items = [new Item('Aged Brie', 10, 10)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(11, $items[0]->quality);
    }

    /** @test */
    public function shouldIncreaseValueForAgedBrieBy2AfterSellBy(): void
    {
        // Arrange
        $items = [new Item('Aged Brie', 0, 10)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(12, $items[0]->quality);
    }

    /** @test */
    public function shouldNeverIncreaseQualityAbove50(): void
    {
        // Arrange
        $items = [new Item('Aged Brie', 10, 50)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }


    /** @test */
    public function sulfurasShouldNeverDecraseQualiy(): void
    {
        // Arrange
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 20)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(20, $items[0]->quality);
    }

    /** @test */
    public function shouldSulfurasNeverNeedsToBeSold(): void
    {
        // Arrange
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 20)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(10, $items[0]->sell_in);
    }

    /** @test */
    public function shouldIncreaseBackstagePassQualityBy1WhenGreaterThan10DaysToSellBy(): void
    {
        // Arrange
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(21, $items[0]->quality);
    }

    /** @test */
    public function shouldIncreaseBackstagePassQualityBy2WhenLessThan11DaysToSellBy(): void
    {
        // Arrange
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 9, 20)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(22, $items[0]->quality);
    }

    /** @test */
    public function shouldIncreaseBackstagePassQualityBy3WhenLessThan6DaysToSellBy(): void
    {
        // Arrange
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(23, $items[0]->quality);
    }

    /** @test */
    public function shouldDropQualityOfBackstagePassAfterSellBy(): void
    {
        // Arrange
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(0, $items[0]->quality);
    }

    /** @test */
    public function shouldBeAbleToCalculateMultipleItems(): void
    {
        // Arrange
        $items = [
            new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20),
            new Item('foo', 5, 20)

        ];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(0, $items[0]->quality);
        $this->assertSame(19, $items[1]->quality);
    }

    /** @test */
    public function shouldNeverIncreaseBackstagePassQualityAbove50(): void
    {
        // Arrange
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(50, $items[0]->quality);
    }

    /** @test */
    public function conjuredItemsShouldLoseQualityTwiceAsFastAsNormalItems(): void
    {
        // Arrange
        $items = [new Item('Conjured Item of Testing', 10, 10)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(8, $items[0]->quality);
    }

    /** @test */
    public function conjuredItemsShouldLoseQualityTwiceAsFastAsNormalItemsWhenPastSellDate(): void
    {
        // Arrange
        $items = [new Item('Conjured Item of Testing', 0, 10)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(6, $items[0]->quality);
    }

    /** @test */
    public function conjuredItemsShouldNeverHaveNegativeQuality(): void
    {
        // Arrange
        $items = [new Item('Conjured Item of Testing', 0, 1)];
        $gildedRose = new GildedRose($items);

        // Act
        $gildedRose->updateQuality();

        // Assert
        $this->assertSame(0, $items[0]->quality);
    }
}
