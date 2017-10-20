<?php

namespace Phpfox\Payments;


class ItemBag implements \IteratorAggregate, \Countable, ItemBagInterface
{
    /**
     * Item storage
     *
     * @var ItemInterface[]
     */
    protected $items;

    /**
     * Constructor
     *
     * @param ItemInterface[] $items An array of items
     */
    public function __construct($items = [])
    {
        $this->replace($items);
    }

    /**
     * @param ItemInterface[] $items
     */
    public function replace($items = [])
    {
        $this->items = [];

        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Add an item to the bag
     *
     * @see Item
     *
     * @param ItemInterface|array $item An existing item, or associative array
     *                                  of item parameters
     */
    public function add($item)
    {
        if ($item instanceof ItemInterface) {
            $this->items[] = $item;
        } else {
            $this->items[] = new Item($item);
        }
    }

    /**
     * Return all the items
     *
     * @return ItemInterface[]
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Returns an iterator for items
     *
     * @return \ArrayIterator An \ArrayIterator instance
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Returns the number of items
     *
     * @return int The number of items
     */
    public function count()
    {
        return count($this->items);
    }
}
