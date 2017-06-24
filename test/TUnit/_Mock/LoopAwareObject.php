<?php

namespace Dazzle\Loop\Test\TUnit\_Mock;

use Dazzle\Loop\LoopAwareInterface;
use Dazzle\Loop\LoopAwareTrait;
use Dazzle\Loop\LoopInterface;

class LoopAwareObject implements LoopAwareInterface
{
    use LoopAwareTrait;

    /**
     * @param LoopInterface|null $loop
     */
    public function __construct(LoopInterface $loop = null)
    {
        $this->loop = $loop;
    }
}
