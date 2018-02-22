<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test\Bridge;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitter;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitterFactory;

class SwooleResponseEmitterFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $container = $this->createMock(ContainerInterface::class);
        $factory = new SwooleResponseEmitterFactory();
        $instance = $factory($container);
        $this->assertInstanceOf(SwooleResponseEmitter::class, $instance);
    }
}
