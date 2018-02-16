<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Bridge;

use Psr\Container\ContainerInterface;
use WShafer\SwooleExpressive\Exception\MissingPipeLineException;
use WShafer\SwooleExpressive\Exception\MissingRoutesException;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

class MiddlewareSetupRunner implements MiddlewareSetupRunnerInterface
{
    /** @var Application */
    protected $application;

    /** @var MiddlewareFactory */
    protected $factory;

    /** @var ContainerInterface */
    protected $container;

    public function __construct(
        Application $application,
        MiddlewareFactory $factory,
        ContainerInterface $container
    ) {
        $this->application = $application;
        $this->factory = $factory;
        $this->container = $container;
    }

    /**
     * @return bool
     * @throws MissingPipeLineException
     * @throws MissingRoutesException
     */
    public function execute() : bool
    {
        $pipeLine = $this->getPipeline();

        if (!$pipeLine) {
            throw new MissingPipeLineException('Cannot locate pipeline');
        }

        $routes = $this->getRoutes();

        if (!$routes) {
            throw new MissingRoutesException('Cannot locate routes');
        }

        // Execute programmatic/declarative middleware pipeline and routing
        // configuration statements
        (require $pipeLine)($this->application, $this->factory, $this->container);
        (require $routes)($this->application, $this->factory, $this->container);

        return true;
    }

    protected function getPipeline()
    {
        if (file_exists($a = __DIR__ . '/../../../../../config/pipeline.php')) {
            return $a;
        }

        return null;
    }

    protected function getRoutes()
    {
        if (file_exists($a = __DIR__ . '/../../../../../config/routes.php')) {
            return $a;
        }

        return null;
    }
}
