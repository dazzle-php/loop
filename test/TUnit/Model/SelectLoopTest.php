<?php

namespace Dazzle\Loop\Test\TUnit;

use Dazzle\Loop\Model\SelectLoop;
use Dazzle\Loop\Test\TUnit;

class SelectLoopTest extends TUnit
{
    /**
     *
     */
    public function testApiConstructor_DoesNotThrowException()
    {
        $this->createLoop();
    }

    /**
     *
     */
    public function testApiDestructor_DoesNotThrowException()
    {
        $loop = $this->createLoop();
        unset($loop);
    }

    /**
     * @return SelectLoop
     */
    protected function createLoop()
    {
        return new SelectLoop();
    }
}
