<?php

namespace WShafer\SwooleExpressive\Bridge;

use Psr\Http\Message\ResponseInterface;
use Swoole\Http\Response as SwooleResponse;

class Response
{
    public static function toSwoole(
        ResponseInterface $psr7Response,
        SwooleResponse $swooleResponse = null
    ) {
        if (!$swooleResponse) {
            $swooleResponse = new SwooleResponse();
        }

        $swooleResponse->status($psr7Response->getStatusCode());
        self::populateHeaders($psr7Response, $swooleResponse);
        self::sendResponse($psr7Response, $swooleResponse);
    }

    protected static function populateHeaders(
        ResponseInterface $psr7Response,
        SwooleResponse $swooleResponse
    ) {
        $headers = $psr7Response->getHeaders();

        foreach ($headers as $name => $value) {
            $swooleResponse->header($name, implode('; ', $value));
        }
    }

    protected static function sendResponse(
        ResponseInterface $psr7Response,
        SwooleResponse $swooleResponse
    ) {
        $content = $psr7Response->getBody();
        $content->rewind();
        $swooleResponse->write($content->getContents());
    }
}
