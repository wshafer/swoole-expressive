<?php

namespace WShafer\SwooleExpressive\Command;

use Psr\Container\ContainerInterface;

class SwooleRunnerCommandFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new SwooleRunnerCommand($container);
    }
}
