<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test\Bridge;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Swoole\Http\Response as SwooleResponse;
use WShafer\SwooleExpressive\Bridge\SwooleResponseEmitter;

class SwooleResponseEmitterTest extends TestCase
{
    /** @var MockObject|ResponseInterface */
    protected $mockPsr7Response;

    /** @var MockObject|SwooleResponse */
    protected $mockSwooleResponse;

    /** @var SwooleResponseEmitter */
    protected $emitter;

    public function setup()
    {
        $this->mockPsr7Response = $this->createMock(ResponseInterface::class);
        $this->mockSwooleResponse = $this->createMock(SwooleResponse::class);
        $this->emitter = new SwooleResponseEmitter();
        $this->assertInstanceOf(SwooleResponseEmitter::class, $this->emitter);
    }

    public function testConstructor()
    {
    }

    public function testToSwoole()
    {
        $this->mockPsr7Response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(404);

        $this->mockSwooleResponse->expects($this->once())
            ->method('status')
            ->with(404)
            ->willReturn(null);

        $headers = [
            'Content-Type' => ['text/javascript', 'text/css'],
            'Set-Cookie' => ['cookie-one', 'cookie-end']
        ];

        $this->mockPsr7Response->expects($this->once())
            ->method('getHeaders')
            ->willReturn($headers);

        $this->mockSwooleResponse->expects($this->exactly(2))
            ->method('header')
            ->withConsecutive(
                [$this->equalTo('Content-Type'), $this->equalTo('text/javascript, text/css'), $this->isNull()],
                [$this->equalTo('Set-Cookie'), $this->equalTo('cookie-end'), $this->isNull()]
            );

        $mockStream = $this->createMock(StreamInterface::class);

        $this->mockPsr7Response->expects($this->once())
            ->method('getBody')
            ->willReturn($mockStream);

        $mockStream->expects($this->once())
            ->method('rewind')
            ->willReturn(null);

        $content = 'This is some body';

        $mockStream->expects($this->once())
            ->method('getContents')
            ->willReturn($content);

        $this->mockSwooleResponse->expects($this->once())
            ->method('end')
            ->with($this->equalTo($content));

        $this->emitter->toSwoole($this->mockPsr7Response, $this->mockSwooleResponse);
    }
}
