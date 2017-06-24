<?php

namespace Dazzle\Loop\Test\TUnit\_Mock\Timer;

use Dazzle\Loop\Tick\TickFiniteQueue;
use SplQueue;

class TickFiniteQueueMock extends TickFiniteQueue
{
    /**
     * @return SplQueue
     */
    public function getQueue()
    {
        return $this->queue;
    }
}
