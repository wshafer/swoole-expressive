<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test\Bridge;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\SwooleExpressive\Bridge\MiddlewareSetupRunner;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

class MiddlewareSetupRunnerTest extends TestCase
{
    /** @var MockObject|ContainerInterface */
    protected $mockContainer;

    /** @var MiddlewareFactory */
    protected $mockMiddleware;

    /** @var MockObject|Application */
    protected $mockApplication;

    /** @var MiddlewareSetupRunner */
    protected $runner;

    protected $mockPipeline = __DIR__.'/../Mock/MockPipeline.php';
    protected $mockRoutes = __DIR__.'/../Mock/MockRoutes.php';

    public function setup()
    {
        $this->mockContainer = $this->createMock(ContainerInterface::class);

        $this->mockApplication = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockMiddleware = $this->getMockBuilder(MiddlewareFactory::class)
            ->disableOriginalConstructor()
            ->getMock();


        $this->runner = new MiddlewareSetupRunner(
            $this->mockApplication,
            $this->mockMiddleware,
            $this->mockContainer
        );

        $this->assertInstanceOf(MiddlewareSetupRunner::class, $this->runner);
    }

    public function testConstructor()
    {
    }

    public function testSetAndGetPipeline()
    {
        $this->runner->setPipelineFilePath($this->mockPipeline);
        $result = $this->runner->getPipeline();
        $this->assertEquals($this->mockPipeline, $result);
    }

    /**
     * @expectedException \WShafer\SwooleExpressive\Exception\MissingPipeLineException
     */
    public function testSetPipelineFileNotFound()
    {
        $this->runner->setPipelineFilePath('not-here');
    }

    public function testSetAndGetRoutes()
    {
        $this->runner->setRoutesFilePath($this->mockRoutes);
        $result = $this->runner->getRoutes();
        $this->assertEquals($this->mockRoutes, $result);
    }

    /**
     * @expectedException \WShafer\SwooleExpressive\Exception\MissingRoutesException
     */
    public function testSetRoutesFileNotFound()
    {
        $this->runner->setRoutesFilePath('not-here');
    }

    public function testExecute()
    {
        $this->runner->setPipelineFilePath($this->mockPipeline);
        $this->runner->setRoutesFilePath($this->mockRoutes);
        $result = $this->runner->execute();
        $this->assertTrue($result);
    }
}
