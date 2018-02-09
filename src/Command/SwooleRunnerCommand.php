<?php

namespace WShafer\SwooleExpressive\Command;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SwooleRunnerCommand extends Command
{
    /** @var ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container, ?string $name = null)
    {
        $this->container = $container;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('swoole:expressive:runner')
            ->setDescription('Run Expressive inside Swoole web server')
            ->setHelp('This command will start a Swoole web server for Zend Expressive');

        $this->addOption(
            'host',
            'i',
            InputOption::VALUE_OPTIONAL,
            'Swoole host to listen to.',
            '0.0.0.0'
        );

        $this->addOption(
            'port',
            'p',
            InputOption::VALUE_OPTIONAL,
            'Swoole port number to listen on.',
            8080
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $input->getOption('host');
        $port = $input->getOption('port');

        $http = new \swoole_http_server($host, $port);

        /** @var \Zend\Expressive\Application $app */
        $app = $this->container->get(\Zend\Expressive\Application::class);
        $factory = $this->container->get(\Zend\Expressive\MiddlewareFactory::class);

        $pipeLine = $this->getPipeline();

        if (!$pipeLine) {
            $output->writeln('Cannot locate pipeline');
            exit(1);
        }

        $routes = $this->getRoutes();

        if (!$routes) {
            $output->writeln('Cannot locate routes');
            exit(1);
        }

        // Execute programmatic/declarative middleware pipeline and routing
        // configuration statements
        (require $pipeLine)($app, $factory, $this->container);
        (require $routes)($app, $factory, $this->container);

        /** @var \Psr\Http\Server\RequestHandlerInterface $handler */
        $handler = $this->container->get(\Zend\Expressive\ApplicationPipeline::class);

        $http->on('request', function ($request, $response) use ($handler) {
            $psrResponse = $handler->handle(
                \WShafer\SwooleExpressive\Bridge\Request::toPsr7($request)
            );

            \WShafer\SwooleExpressive\Bridge\Response::toSwoole($psrResponse, $response);
        });

        $http->start();
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
