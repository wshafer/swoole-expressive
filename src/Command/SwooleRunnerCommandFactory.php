<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Command;

use Psr\Container\ContainerInterface;
use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunnerInterface;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilder;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitter;

class SwooleRunnerCommandFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var \Zend\Expressive\Application $app */
        $app = $container->get(\Zend\Expressive\Application::class);

        /** @var MiddlewareSetupRunnerInterface $factory */
        $setupRunner = $container->get(MiddlewareSetupRunnerInterface::class);

        /** @var Psr7RequestBuilder $requestBuilder */
        $requestBuilder  = $container->get(Psr7RequestBuilder::class);

        /** @var SwooleResponseEmitter $responseEmitter */
        $responseEmitter = $container->get(SwooleResponseEmitter::class);

        return new SwooleRunnerCommand($app, $setupRunner, $requestBuilder, $responseEmitter);
    }
}
