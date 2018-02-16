<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Bridge;

use Psr\Container\ContainerInterface;

class Psr7RequestBuilderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Psr7RequestBuilder();
    }
}
