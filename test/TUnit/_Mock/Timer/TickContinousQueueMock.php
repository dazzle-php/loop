<?php

namespace Dazzle\Loop\Test\TUnit\_Mock\Timer;

use Dazzle\Loop\Tick\TickContinousQueue;
use SplQueue;

class TickContinousQueueMock extends TickContinousQueue
{
    /**
     * @return SplQueue
     */
    public function getQueue()
    {
        return $this->queue;
    }
}
