<?php

namespace Dazzle\Loop\Test\TUnit\Bridge\React;

use Dazzle\Loop\Bridge\React\ReactLoopInterface;
use Dazzle\Loop\Bridge\React\ReactTimer;
use Dazzle\Loop\LoopInterface;
use Dazzle\Loop\Timer\TimerInterface;
use Dazzle\Loop\Test\TUnit;

class ReactTimerTest extends TUnit
{
    /**
     *
     */
    public function testApiGetActualTimer_ReturnsTimerPassedInConstructor()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $timer = $this->createTimerMock();
        $react = new ReactTimer($timer);

        $this->assertSame($timer, $react->getActualTimer());
    }

    /**
     *
     */
    public function testApiGetLoop_ReturnsReactLoop()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $react = $this->createApiMethodMock(
            'getLoop',
            function() {
                return $this->getMock(LoopInterface::class);
            }
        );

        $this->assertInstanceOf(ReactLoopInterface::class, $react->getLoop());
    }

    /**
     *
     */
    public function testApiGetInterval_ReturnsProperInterval()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $interval = 1e-23;
        $react = $this->createApiMethodMock(
            'getInterval',
            function() use($interval) {
                return $interval;
            }
        );

        $this->assertEquals($interval, $react->getInterval());
    }

    /**
     *
     */
    public function testApiGetCallback_ReturnsProperCallback()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $callback = $this->createCallableMock();
        $react = $this->createApiMethodMock(
            'getCallback',
            function() use($callback) {
                return $callback;
            }
        );

        $this->assertSame($callback, $react->getCallback());
    }

    /**
     *
     */
    public function testApiSetData_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $expectedData = $this->getMock('StdClass');
        $react = $this->createApiMethodMock(
            'setData',
            function($data) use($expectedData) {
                $this->assertSame($expectedData, $data);
            }
        );

        $react->setData($expectedData);
    }

    /**
     *
     */
    public function testApiGetData_ReturnsProperData()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $expectedData = $this->getMock('StdClass');
        $react = $this->createApiMethodMock(
            'getData',
            function() use($expectedData) {
                return $expectedData;
            }
        );

        $this->assertSame($expectedData, $react->getData());
    }

    /**
     * @dataProvider boolVariantProvider
     */
    public function testApiIsPeriodic_CallsActualIsPeriodic($bool)
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $react = $this->createApiMethodMock(
            'isPeriodic',
            function() use($bool) {
                return $bool;
            }
        );

        $this->assertEquals($bool, $react->isPeriodic());
    }

    /**
     * @dataProvider boolVariantProvider
     */
    public function testApiIsActive_CallsActualIsActive($bool)
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $react = $this->createApiMethodMock(
            'isActive',
            function() use($bool) {
                return $bool;
            }
        );

        $this->assertEquals($bool, $react->isActive());
    }

    /**
     *
     */
    public function testApiCancel_CallsActualCancel()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $react = $this->createApiMethodMock(
            'cancel',
            function() {}
        );

        $react->cancel();
    }

    /**
     * @param string $method
     * @param callable $validator
     * @return ReactTimer
     */
    protected function createApiMethodMock($method, callable $validator)
    {
        $timer = $this->createTimerMock();
        $react = new ReactTimer($timer);
        $timer
            ->expects($this->once())
            ->method($method)
            ->will($this->returnCallback($validator))
        ;
        return $react;
    }

    /**
     * @return TimerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function createTimerMock()
    {
        return $this->getMock(TimerInterface::class);
    }

    /**
     * @internal
     * @return bool[][]
     */
    public function boolVariantProvider()
    {
        return [
            [ true ],
            [ false ]
        ];
    }
}
