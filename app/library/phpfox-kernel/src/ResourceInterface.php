<?php

namespace Phpfox\Kernel;

use Phpfox\Model\ModelInterface;

interface ResourceInterface extends ModelInterface
{
    public function getId();
}