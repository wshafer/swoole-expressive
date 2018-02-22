<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test\Bridge;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunner;
use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunnerFactory;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

class MiddlewareSetupRunnerFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $mockContainer = $this->createMock(ContainerInterface::class);

        $mockApp = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockMiddleware = $this->getMockBuilder(MiddlewareFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $map = [
            [Application::class, $mockApp],
            [MiddlewareFactory::class, $mockMiddleware],
        ];

        $mockContainer->expects($this->exactly(2))
            ->method('get')
            ->will($this->returnValueMap($map));

        $factory = new MiddlewareSetupRunnerFactory();
        $instance = $factory($mockContainer);
        $this->assertInstanceOf(MiddlewareSetupRunner::class, $instance);
    }
}
