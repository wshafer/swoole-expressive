<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Swoole\Http\Request as SwooleRequest;
use WShafer\SwooleExpressive\Bridge\Psr7RequestBuilder;
use WShafer\SwooleExpressive\Bridge\Request;
use WShafer\SwooleExpressive\Test\Mock\RequestMockTrait;
use Zend\Diactoros\ServerRequest;

class Psr7RequestBuilderTest extends TestCase
{
    use RequestMockTrait;

    /** @var MockObject */
    protected $mockRequest;

    /** @var Psr7RequestBuilder */
    protected $requestBuilder;


    public function setup()
    {
        $this->requestBuilder = new Psr7RequestBuilder();
        $this->mockRequest = $this->createMock(SwooleRequest::class);
    }

    protected function buildUpMockRequest($data)
    {
        $this->mockRequest->fd       = $data['fd'];
        $this->mockRequest->header   = $data['header'];
        $this->mockRequest->server   = $data['server'];
        $this->mockRequest->request  = $data['request'];
        $this->mockRequest->cookie   = $data['cookie'];
        $this->mockRequest->get      = $data['get'];
        $this->mockRequest->files    = $data['files'];
        $this->mockRequest->post     = $data['post'];
        $this->mockRequest->tmpfiles = $data['tmpfiles'];
    }

    public function testToPsr7WithDefaults()
    {
        $psr7Request = $this->requestBuilder->build($this->mockRequest);
        $this->assertInstanceOf(ServerRequest::class, $psr7Request);
    }

    protected function headerTest($headers, ServerRequest $psr7Request)
    {
        foreach ($headers as $name => $value) {
            $this->assertEquals(
                $value,
                $psr7Request->getHeader($name)[0]
            );
        }
    }

    public function testToPsr7WithValues()
    {
        $request = $this->getRequestMock();
        $this->buildUpMockRequest($request);
        $this->mockRequest->expects($this->once())
            ->method('rawcontent')
            ->willReturn('');

        $psr7Request = $this->requestBuilder->build($this->mockRequest);
        $this->assertInstanceOf(ServerRequest::class, $psr7Request);

        $this->assertEquals(
            $request['server'] ?? [],
            $psr7Request->getServerParams()
        );

        $this->assertEquals(
            $request['files'] ?? [],
            $psr7Request->getUploadedFiles()
        );

        $this->headerTest($request['header'], $psr7Request);
    }

    public function testToPsr7WithPostData()
    {
        $request = $this->getFormPostMock();
        $this->buildUpMockRequest($request);
        $this->mockRequest->expects($this->once())
            ->method('rawcontent')
            ->willReturn('');

        $psr7Request = $this->requestBuilder->build($this->mockRequest);
        $this->assertInstanceOf(ServerRequest::class, $psr7Request);

        $this->assertEquals(
            $request['server'] ?? [],
            $psr7Request->getServerParams()
        );

        $this->assertEquals(
            $request['files'] ?? [],
            $psr7Request->getUploadedFiles()
        );

        $this->headerTest($request['header'], $psr7Request);

        $this->assertEquals(
            $request['post'],
            $psr7Request->getParsedBody()
        );
    }
}
