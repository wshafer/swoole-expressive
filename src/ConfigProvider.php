<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive;

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
            ],
        ];
    }
}
