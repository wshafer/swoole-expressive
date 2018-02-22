<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Bridge;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

class MiddlewareSetupRunnerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var \Zend\Expressive\Application $app */
        $app = $container->get(Application::class);

        /** @var \Zend\Expressive\MiddlewareFactory $factory */
        $factory = $container->get(MiddlewareFactory::class);

        return new MiddlewareSetupRunner($app, $factory, $container);
    }
}
