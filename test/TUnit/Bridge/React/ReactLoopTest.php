<?php

namespace Dazzle\Loop\Test\TUnit\Bridge\React;

use Dazzle\Loop\Bridge\React\ReactLoop;
use Dazzle\Loop\Test\TUnit;

class ReactLoopTest extends TUnit
{
    /**
     * @var resource
     */
    private $fp;

    /**
     *
     */
    public function tearDown()
    {
        $this->destroyMemoryStream();

        parent::tearDown();
    }

    /**
     *
     */
    public function testApiGetActualLoop_ReturnsLoopPassedInConstructor()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            return $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $loop = $this->createLoopMock();
        $react = new ReactLoop($loop);
        $this->assertSame($loop, $react->getActualLoop());
    }

    /**
     *
     */
    public function testApiAddReadStream_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            return $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $stream = $this->createMemoryStream();
        $listener = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'addReadStream',
            function($passedStream, $passedListener) use($stream, $listener) {
                $this->assertSame($stream, $passedStream);
                $this->assertSame($listener, $passedListener);
            }
        );

        $react->addReadStream($stream, $listener);
    }

    /**
     *
     */
    public function testApiAddWriteStream_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            return $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $stream = $this->createMemoryStream();
        $listener = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'addWriteStream',
            function($passedStream, $passedListener) use($stream, $listener) {
                $this->assertSame($stream, $passedStream);
                $this->assertSame($listener, $passedListener);
            }
        );

        $react->addWriteStream($stream, $listener);
    }

    /**
     *
     */
    public function testApiRemoveReadStream_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $stream = $this->createMemoryStream();

        $react = $this->createApiMethodMock(
            'removeReadStream',
            function($passedStream) use($stream) {
                $this->assertSame($stream, $passedStream);
            }
        );

        $react->removeReadStream($stream);
    }

    /**
     *
     */
    public function testApiRemoveWriteStream_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $stream = $this->createMemoryStream();

        $react = $this->createApiMethodMock(
            'removeWriteStream',
            function($passedStream) use($stream) {
                $this->assertSame($stream, $passedStream);
            }
        );

        $react->removeWriteStream($stream);
    }

    /**
     *
     */
    public function testApiRemoveStream_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $stream = $this->createMemoryStream();

        $react = $this->createApiMethodMock(
            'removeStream',
            function($passedStream) use($stream) {
                $this->assertSame($stream, $passedStream);
            }
        );

        $react->removeStream($stream);
    }

    /**
     *
     */
    public function testApiAddTimer_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $interval = 5e-1;
        $callback = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'addTimer',
            function($passedInterval, $passedCallback) use($interval, $callback) {
                $this->assertEquals($passedInterval, $interval);
                $this->assertSame($passedCallback, $callback);
                return $this->getMock(
                    \Dazzle\Loop\Timer\TimerInterface::class
                );
            }
        );

        $react->addTimer($interval, $callback);
    }

    /**
     *
     */
    public function testApiAddTimer_ReturnsReactTimer()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $interval = 5e-1;
        $callback = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'addTimer',
            function($interval, $callback) {
                return $this->getMock(
                    \Dazzle\Loop\Timer\TimerInterface::class
                );
            }
        );

        $this->assertInstanceOf(
            \React\EventLoop\Timer\TimerInterface::class,
            $react->addTimer($interval, $callback)
        );
    }

    /**
     *
     */
    public function testApiAddPeriodicTimer_PassesProperParameters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $interval = 5e-1;
        $callback = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'addPeriodicTimer',
            function($passedInterval, $passedCallback) use($interval, $callback) {
                $this->assertEquals($passedInterval, $interval);
                $this->assertSame($passedCallback, $callback);
                return $this->getMock(
                    \Dazzle\Loop\Timer\TimerInterface::class
                );
            }
        );

        $react->addPeriodicTimer($interval, $callback);
    }

    /**
     *
     */
    public function testApiAddPeriodicTimer_ReturnsReactTimer()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $interval = 5e-1;
        $callback = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'addPeriodicTimer',
            function($interval, $callback) {
                return $this->getMock(
                    \Dazzle\Loop\Timer\TimerInterface::class
                );
            }
        );

        $this->assertInstanceOf(
            \React\EventLoop\Timer\TimerInterface::class,
            $react->addPeriodicTimer($interval, $callback)
        );
    }

    /**
     *
     */
    public function testCancelTimer_CallsActualCancelTimer()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $mockedTimer = $this->getMock(
            \Dazzle\Loop\Timer\TimerInterface::class
        );

        $timer = $this->getMock(\Dazzle\Loop\Bridge\React\ReactTimerInterface::class);
        $timer
            ->expects($this->once())
            ->method('getActualTimer')
            ->will($this->returnCallback(function() use($mockedTimer) {
                return $mockedTimer;
            }))
        ;

        $react = $this->createApiMethodMock(
            'cancelTimer',
            function($passedTimer) use($mockedTimer) {
                $this->assertSame($mockedTimer, $passedTimer);
            }
        );

        $react->cancelTimer($timer);
    }

    /**
     *
     */
    public function testApiIsTimerActive_CallsActualIsTimerActive()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $mockedTimer = $this->getMock(
            \Dazzle\Loop\Timer\TimerInterface::class
        );

        $timer = $this->getMock(\Dazzle\Loop\Bridge\React\ReactTimerInterface::class);
        $timer
            ->expects($this->once())
            ->method('getActualTimer')
            ->will($this->returnCallback(function() use($mockedTimer) {
                return $mockedTimer;
            }))
        ;

        $react = $this->createApiMethodMock(
            'isTimerActive',
            function($passedTimer) use($mockedTimer) {
                $this->assertSame($mockedTimer, $passedTimer);
            }
        );

        $react->isTimerActive($timer);
    }

    /**
     *
     */
    public function testApiNextTick_PassesProperParamters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $listener = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'onBeforeTick',
            function($passedListener) use($listener) {
                $this->assertSame($listener, $passedListener);
            }
        );

        $react->nextTick($listener);
    }

    /**
     *
     */
    public function testApiFutureTick_PassesProperParamters()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $listener = $this->createCallableMock();

        $react = $this->createApiMethodMock(
            'onAfterTick',
            function($passedListener) use($listener) {
                $this->assertSame($listener, $passedListener);
            }
        );

        $react->futureTick($listener);
    }

    /**
     *
     */
    public function testApiTick_NeverTicksLoop()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $this->markTestSkipped(
            'Seems there is a problem with PHPUnit 5.2 compatibility here.'
        );

        $loop = $this->createLoopMock();
        $react = new ReactLoop($loop);

        $loop
            ->expects($this->never())
            ->method('tick');

        $react->tick();
    }

    /**
     *
     */
    public function testApiRun_NeverRunsLoop()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $this->markTestSkipped(
            'Seems there is a problem with PHPUnit 5.2 compatibility here.'
        );

        $loop = $this->createLoopMock();
        $react = new ReactLoop($loop);

        $loop
            ->expects($this->never())
            ->method('start');

        $react->run();
    }

    /**
     *
     */
    public function testApiStop_NeverStopsLoop()
    {
        if (!interface_exists('React\EventLoop\LoopInterface'))
        {
            $this->markTestSkipped('This test requires React\EventLoop instance to work');
        }

        $this->markTestSkipped(
            'Seems there is a problem with PHPUnit 5.2 compatibility here.'
        );

        $loop = $this->createLoopMock();
        $react = new ReactLoop($loop);

        $loop
            ->expects($this->never())
            ->method('stop');

        $react->stop();
    }

    /**
     * @param string $method
     * @param callable $validator
     * @return ReactLoop
     */
    protected function createApiMethodMock($method, callable $validator)
    {
        $loop = $this->createLoopMock();
        $react = new ReactLoop($loop);
        $loop
            ->expects($this->once())
            ->method($method)
            ->will($this->returnCallback($validator))
        ;
        return $react;
    }

    /**
     * @return resource
     */
    private function createMemoryStream()
    {
        $this->fp = fopen('php://memory', 'r+');
        return $this->fp;
    }

    /**
     *
     */
    private function destroyMemoryStream()
    {
        if (is_resource($this->fp))
        {
            unset($this->fp);
        }
    }
}
