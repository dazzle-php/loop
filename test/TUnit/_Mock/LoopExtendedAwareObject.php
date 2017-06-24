<?php

namespace Dazzle\Loop\Test\TUnit\_Mock;

use Dazzle\Loop\LoopExtendedAwareInterface;
use Dazzle\Loop\LoopExtendedAwareTrait;
use Dazzle\Loop\LoopExtendedInterface;

class LoopExtendedAwareObject implements LoopExtendedAwareInterface
{
    use LoopExtendedAwareTrait;

    /**
     * @param LoopExtendedInterface|null $loop
     */
    public function __construct(LoopExtendedInterface $loop = null)
    {
        $this->loop = $loop;
    }
}
