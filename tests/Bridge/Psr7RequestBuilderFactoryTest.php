<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test\Bridge;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilder;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilderFactory;

class Psr7RequestBuilderFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $container = $this->createMock(ContainerInterface::class);
        $factory = new Psr7RequestBuilderFactory();
        $instance = $factory($container);
        $this->assertInstanceOf(Psr7RequestBuilder::class, $instance);
    }
}
