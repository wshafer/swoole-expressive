<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Bridge;

use Swoole\Http\Request as SwooleRequest;
use Zend\Diactoros\ServerRequest;

class Psr7RequestBuilder
{
    public function build(SwooleRequest $swooleRequest)
    {
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
