<?php

namespace Dazzle\Loop\Test\TModule;

use Dazzle\Loop\LoopFactory;
use Dazzle\Loop\LoopModelInterface;
use Dazzle\Loop\Model\SelectLoop;
use Dazzle\Loop\Test\TModule;

class LoopFactoryTest extends TModule
{
    /**
     * LoopFactoryInterface
     */
    public function createFactory()
    {
        return new LoopFactory();
    }

    /**
     * @return string[]
     */
    public function getModels()
    {
        return [
            'SelectLoop' => SelectLoop::class
        ];
    }

    /**
     *
     */
    public function testCaseFactory_PossesDefinitionForAllModels()
    {
        $factory = $this->createFactory();
        $models = $this->getModels();

        foreach ($models as $alias=>$class)
        {
            $this->assertTrue($factory->hasDefinition($alias));
            $this->assertInstanceOf($class, $model = $factory->create($alias));
            $this->assertInstanceOf(LoopModelInterface::class, $model);
        }
    }
}
