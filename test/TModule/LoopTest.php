<?php

namespace Dazzle\Loop\Test\TModule;

use Dazzle\Loop\Flow\FlowController;
use Dazzle\Loop\Model\SelectLoop;
use Dazzle\Loop\Loop;
use Dazzle\Loop\LoopExtendedInterface;
use Dazzle\Loop\LoopModelInterface;
use Dazzle\Loop\Test\TModule;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class LoopTest extends LoopModelTest
{
    /**
     * @return LoopExtendedInterface|LoopModelInterface
     */
    public function createLoop()
    {
        return new Loop(new SelectLoop());
    }
}
