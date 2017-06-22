<?php

namespace Dazzle\Loop\Bridge\React;

use Dazzle\Loop\Timer\TimerInterface;

interface ReactTimerInterface extends \React\EventLoop\Timer\TimerInterface
{
    /**
     * Return the actual TimerInterface which is adapted by current ReactTimerInterface.
     *
     * @return TimerInterface;
     */
    public function getActualTimer();
}
