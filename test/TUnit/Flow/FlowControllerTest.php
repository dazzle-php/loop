<?php

namespace Dazzle\Loop\Test\TUnit\Flow;

use Dazzle\Loop\Flow\FlowController;
use Dazzle\Loop\Test\TUnit;

class FlowControllerTest extends TUnit
{
    /**
     * @return FlowController
     */
    public function createFlowController()
    {
        return new FlowController;
    }

    /**
     *
     */
    public function testApiConstructor_DoesNotThrowExceptions()
    {
        $controller = $this->createFlowController();
    }

    /**
     *
     */
    public function testApiDestructor_DoesNotThrowExceptions()
    {
        $controller = $this->createFlowController();
        unset($controller);
    }

    /**
     *
     */
    public function testApiIsRunning_ReturnsFalse_AfterCreation()
    {
        $controller = $this->createFlowController();

        $this->assertFalse($controller->isRunning());
    }

    /**
     *
     */
    public function testApiIsRunning_ReturnsFalse_WhenFlowControllerIsStopped()
    {
        $controller = $this->createFlowController();
        $controller->isRunning = false;

        $this->assertFalse($controller->isRunning());
    }

    /**
     *
     */
    public function testApiIsRunning_ReturnsTrue_WhenFlowControllerIsStarted()
    {
        $controller = $this->createFlowController();
        $controller->isRunning = true;

        $this->assertTrue($controller->isRunning());
    }

    /**
     *
     */
    public function testApiStart_StartsFlowController()
    {
        $controller = $this->createFlowController();

        $this->assertFalse($controller->isRunning());
        $controller->start();
        $this->assertTrue($controller->isRunning());
    }

    /**
     *
     */
    public function testApiStop_StopsFlowController()
    {
        $controller = $this->createFlowController();

        $controller->start();
        $this->assertTrue($controller->isRunning());

        $controller->stop();
        $this->assertFalse($controller->isRunning());
    }
}
