<?php

namespace Phpfox\Form;


interface RepeaterInterface extends FieldsetInterface
{
    public function getRepeat();

    public function setRepeat($number);

    public function getShow();

    public function setShow($number);
}