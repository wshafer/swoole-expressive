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

    protected $pipelineFile =  __DIR__ . '/../../../../../config/pipeline.php';

    protected $routeFile = __DIR__ . '/../../../../../config/routes.php';

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

        $pipeLineRunner = require $pipeLine;
        $pipeLineRunner($this->application, $this->factory, $this->container);

        $routeRunner = require $routes;
        $routeRunner($this->application, $this->factory, $this->container);

        return true;
    }

    public function getPipeline()
    {
        if (file_exists($this->pipelineFile)) {
            return $this->pipelineFile;
        }

        return null;
    }

    public function getRoutes()
    {
        if (file_exists($this->routeFile)) {
            return $this->routeFile;
        }

        return null;
    }

    /**
     * @param $path
     * @throws MissingPipeLineException
     */
    public function setPipelineFilePath($path)
    {
        if (!file_exists($path)) {
            throw new MissingPipeLineException($path.' does not exist or is not readable');
        }

        $this->pipelineFile = $path;
    }

    /**
     * @param $path
     * @throws MissingRoutesException
     */
    public function setRoutesFilePath($path)
    {
        if (!file_exists($path)) {
            throw new MissingRoutesException($path.' does not exist or is not readable');
        }

        $this->routeFile = $path;
    }
}
