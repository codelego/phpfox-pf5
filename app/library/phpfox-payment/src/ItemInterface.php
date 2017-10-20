<?php

namespace Phpfox\Payments;


interface ItemInterface
{
    /**
     * Name of the item
     *
     * @return mixed
     */
    public function getName();

    /**
     * Description of the item
     *
     * @return  mixed
     */
    public function getDescription();

    /**
     * Quantity of the item
     *
     * @return mixed
     */
    public function getQuantity();

    /**
     * Price of the item
     *
     * @return mixed
     */
    public function getPrice();

    /**
     * @return mixed
     */
    public function getCode();
}