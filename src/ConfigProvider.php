<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive;

use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunnerFactory;
use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunnerInterface;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilder;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilderFactory;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitter;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitterFactory;
use WShafer\SwooleExpressive\Command\SwooleRunnerCommand;
use WShafer\SwooleExpressive\Command\SwooleRunnerCommandFactory;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies() : array
    {
        return [
            'aliases' => [],
            'factories' => [
                SwooleRunnerCommand::class => SwooleRunnerCommandFactory::class,
                SwooleResponseEmitter::class => SwooleResponseEmitterFactory::class,
                Psr7RequestBuilder::class => Psr7RequestBuilderFactory::class,
                MiddlewareSetupRunnerInterface::class => MiddlewareSetupRunnerFactory::class,
            ],
        ];
    }
}
