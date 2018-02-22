<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Command;

use Psr\Container\ContainerInterface;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunnerInterface;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilder;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitter;
use WShafer\SwooleExpressive\Exception\MissingPipeLineException;
use WShafer\SwooleExpressive\Exception\SwooleExpressiveException;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

class SwooleRunnerCommand extends Command
{
    /** @var ContainerInterface */
    protected $container;

    /** @var Application */
    protected $app;

    /** @var MiddlewareSetupRunnerInterface */
    protected $setupRunner;

    /** @var Psr7RequestBuilder */
    protected $requestBuilder;

    /** @var SwooleResponseEmitter */
    protected $responseEmitter;

    public function __construct(
        Application $application,
        MiddlewareSetupRunnerInterface $setupRunner,
        Psr7RequestBuilder $requestBuilder,
        SwooleResponseEmitter $responseEmitter,
        ?string $name = null
    ) {
        $this->app = $application;
        $this->setupRunner = $setupRunner;
        $this->requestBuilder = $requestBuilder;
        $this->responseEmitter = $responseEmitter;
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
        try {
            $this->setupRunner->execute();
        } catch (SwooleExpressiveException $e) {
            $output->writeln($e->getMessage());
            throw $e;
        }

        $host = $input->getOption('host');
        $port = $input->getOption('port');

        $http = new \swoole_http_server($host, $port);
        $app = $this->app;
        $requestBuilder = $this->requestBuilder;
        $responseEmitter = $this->responseEmitter;

        $http->on(
            'request',
            function (Request $request, Response $response) use ($app, $requestBuilder, $responseEmitter) {
                $psrResponse = $app->handle($requestBuilder->build($request));
                $responseEmitter->toSwoole($psrResponse, $response);
            }
        );

        $http->start();
    }
}
