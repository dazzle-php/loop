<?php

namespace Dazzle\Loop\Test\TUnit;

use Dazzle\Loop\Test\TUnit\_Mock\LoopExtendedAwareObject;
use Dazzle\Loop\Test\TUnit\_Mock\LoopModelMock;
use Dazzle\Loop\Loop;
use Dazzle\Loop\Test\TUnit;

class LoopExtendedAwareObjectTest extends TUnit
{
    /**
     * @return Loop
     */
    public function createLoop()
    {
        return new Loop(new LoopModelMock);
    }

    /**
     * @param Loop|null $loop
     * @return LoopExtendedAwareObject
     */
    public function createObject(Loop $loop = null)
    {
        return new LoopExtendedAwareObject($loop);
    }

    /**
     *
     */
    public function testApiSetLoop_SetsLoop()
    {
        $loop = $this->createLoop();
        $object = $this->createObject();

        $this->assertSame(null, $object->getLoop());
        $object->setLoop($loop);
        $this->assertSame($loop, $object->getLoop());
    }

    /**
     *
     */
    public function testApiGetLoop_GetsLoop()
    {
        $loop = $this->createLoop();
        $object = $this->createObject($loop);

        $this->assertSame($loop, $object->getLoop());
    }
}
