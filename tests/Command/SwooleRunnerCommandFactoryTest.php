<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test\Command;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunnerInterface;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilder;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitter;
use WShafer\SwooleExpressive\Command\SwooleRunnerCommand;
use WShafer\SwooleExpressive\Command\SwooleRunnerCommandFactory;
use Zend\Expressive\Application;

class MiddlewareSetupRunnerFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $mockContainer = $this->createMock(ContainerInterface::class);

        $mockApp = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockMiddlewareSetup = $this->getMockBuilder(MiddlewareSetupRunnerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockRequestBuilder = $this->getMockBuilder(Psr7RequestBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockResponseEmitter = $this->getMockBuilder(SwooleResponseEmitter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $map = [
            [Application::class, $mockApp],
            [MiddlewareSetupRunnerInterface::class, $mockMiddlewareSetup],
            [Psr7RequestBuilder::class, $mockRequestBuilder],
            [SwooleResponseEmitter::class, $mockResponseEmitter],
        ];

        $mockContainer->expects($this->exactly(4))
            ->method('get')
            ->will($this->returnValueMap($map));

        $factory = new SwooleRunnerCommandFactory();
        $instance = $factory($mockContainer);
        $this->assertInstanceOf(SwooleRunnerCommand::class, $instance);
    }
}
