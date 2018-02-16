<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Bridge;

use Psr\Container\ContainerInterface;

class MiddlewareSetupRunnerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var \Zend\Expressive\Application $app */
        $app = $container->get(\Zend\Expressive\Application::class);

        /** @var \Zend\Expressive\MiddlewareFactory $factory */
        $factory = $container->get(\Zend\Expressive\MiddlewareFactory::class);

        return new MiddlewareSetupRunner($app, $factory, $container);
    }
}
