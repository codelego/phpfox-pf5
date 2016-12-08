<?php

namespace Phpfox\Support;

use Phpfox\Model\ModelInterface;

interface ResourceInterface extends ModelInterface
{
    public function getId();
}