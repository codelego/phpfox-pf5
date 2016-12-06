<?php
namespace Phpfox\Payments;

interface ItemBagInterface
{
    /**
     * @param ItemInterface[] $items
     */
    public function replace($items = []);

    /**
     * Add an item to the bag
     *
     * @see Item
     *
     * @param ItemInterface|array $item An existing item, or associative array
     *                                  of item parameters
     */
    public function add($item);

    /**
     * Return all the items
     *
     * @return ItemInterface[]
     */
    public function all();

    /**
     * Returns an iterator for items
     *
     * @return \ArrayIterator An \ArrayIterator instance
     */
    public function getIterator();

    /**
     * Returns the number of items
     *
     * @return int The number of items
     */
    public function count();
}