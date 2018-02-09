<?php

namespace WShafer\SwooleExpressive\Bridge;

use Swoole\Http\Request as SwooleRequest;
use Zend\Diactoros\ServerRequest;

class Request
{
    public static function toPsr7(
        SwooleRequest $swooleRequest
    ) {
        $body = (string) $swooleRequest->rawcontent();

        if (empty($body)) {
            $body = 'php://input';
        }

        return new ServerRequest(
            $swooleRequest->server ?? [],
            $swooleRequest->files ?? [],
            $swooleRequest->server['request_uri'] ?? null,
            $swooleRequest->server['request_method'] ?? null,
            $body,
            $swooleRequest->header ?? [],
            $swooleRequest->cookie ?? [],
            $swooleRequest->get ?? [],
            $swooleRequest->post ?? null,
            $swooleRequest->server['server_protocol'] ?? '1.1'
        );
    }
}
