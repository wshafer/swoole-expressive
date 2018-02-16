<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Test\Mock;

trait RequestMockTrait
{
    public function getRequestMock()
    {
        return [
            'fd' => 1,
            'header' => [
                'host' => 'localhost:8080',
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:58.0) Gecko/20100101 Firefox/58.0',
                'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'accept-language' => 'en-US,en;q=0.5',
                'accept-encoding' => 'gzip, deflate',
                'dnt' => '1',
                'connection' => 'keep-alive',
                'upgrade-insecure-requests' => '1',
            ],
            'server' => [
                'request_method' => 'GET',
                'request_uri' => '/',
                'path_info' => '/',
                'request_time' => 1518236599,
                'request_time_float' => 1518236599.4486,
                'server_port' => 8080,
                'remote_port' => 55885,
                'remote_addr' => '10.0.2.2',
                'master_time' => 1518236599,
                'server_protocol' => 'HTTP/1.1',
                'server_software' => 'swoole-http-server',
            ],
            'request' => NULL,
            'cookie' => NULL,
            'get' => NULL,
            'files' => NULL,
            'post' => NULL,
            'tmpfiles' => NULL,
        ];
    }

    public function getFormPostMock()
    {
        return [
            'fd' => 3,
            'header' => [
                'cache-control' => 'no-cache',
                'postman-token' => 'afe7fabc-adaf-4770-82ec-96e11e2ac407',
                'user-agent' => 'PostmanRuntime/7.1.1',
                'accept' => '*/*',
                'host' => 'localhost:8080',
                'accept-encoding' => 'gzip, deflate',
                'content-type' => 'multipart/form-data; boundary=--------------------------166769271679051152714386',
                'content-length' => '272',
                'connection' => 'keep-alive',
            ],
            'server' => [
                'request_method' => 'POST',
                'request_uri' => '/',
                'path_info' => '/',
                'request_time' => 1518468402,
                'request_time_float' => 1518468402.560589,
                'server_port' => 8080,
                'remote_port' => 49849,
                'remote_addr' => '10.0.2.2',
                'master_time' => 1518468402,
                'server_protocol' => 'HTTP/1.1',
                'server_software' => 'swoole-http-server',
            ],
            'request' => NULL,
            'cookie' => NULL,
            'get' => NULL,
            'files' => NULL,
            'post' => [
                'test' => 'test',
                'test2' => 'test2',
            ],
            'tmpfiles' => NULL,
        ];
    }

    public function getMockFilePost()
    {
        return [
            'fd' => 3,
            'header' => [
                'content-type' => 'multipart/form-data; boundary=--------------------------300832713124378419925087',
                'cache-control' => 'no-cache',
                'postman-token' => '4670cf73-429b-478c-b985-baa9e4b72c07',
                'user-agent' => 'PostmanRuntime/7.1.1',
                'accept' => '*/*',
                'host' => 'localhost:8080',
                'accept-encoding' => 'gzip, deflate',
                'content-length' => '95245',
                'connection' => 'keep-alive',
            ],
            'server' => [
                'request_method' => 'POST',
                'request_uri' => '/',
                'path_info' => '/',
                'request_time' => 1518471625,
                'request_time_float' => 1518471625.887792,
                'server_port' => 8080,
                'remote_port' => 49849,
                'remote_addr' => '10.0.2.2',
                'master_time' => 1518471625,
                'server_protocol' => 'HTTP/1.1',
                'server_software' => 'swoole-http-server',
            ],
            'request' => NULL,
            'cookie' => NULL,
            'get' => NULL,
            'files' => [
                'testfile' => [
                    'name' => 'Screen Shot 2018-02-07 at 5.34.57 PM.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/swoole.upfile.LTq4xs',
                    'error' => 0,
                    'size' => 94895,
                ],
            ],
            'post' => [
                'test2' => 'test2',
            ],
            'tmpfiles' => [
                0 => '/tmp/swoole.upfile.LTq4xs',
            ],
        ];
    }

    public function getMockRequestWithGetParams()
    {
        return [
            'fd' => 3,
            'header' => [
                'cache-control' => 'no-cache',
                'postman-token' => '8a650de7-f73d-4dd4-8c07-bfc3f10d9f33',
                'user-agent' => 'PostmanRuntime/7.1.1',
                'accept' => '*/*',
                'host' => 'localhost:8080',
                'accept-encoding' => 'gzip, deflate',
                'connection' => 'keep-alive',
            ],
            'server' => [
                'query_string' => 'test=1&test2=2&testarray[0]=param1&testarray[1]=param2',
                'request_method' => 'GET',
                'request_uri' => '/test-get-params',
                'path_info' => '/test-get-params',
                'request_time' => 1518471848,
                'request_time_float' => 1518471849.429033,
                'server_port' => 8080,
                'remote_port' => 49849,
                'remote_addr' => '10.0.2.2',
                'master_time' => 1518471848,
                'server_protocol' => 'HTTP/1.1',
                'server_software' => 'swoole-http-server',
            ],
            'request' => NULL,
            'cookie' => NULL,
            'get' => [
                'test' => '1',
                'test2' => '2',
                'testarray' => [
                    0 => 'param1',
                    1 => 'param2',
                ],
            ],
            'files' => NULL,
            'post' => NULL,
            'tmpfiles' => NULL,
        ];
    }

    public function getMockRequestWithCookies()
    {
        [
            'fd' => 3,
            'header' => [
                'cache-control' => 'no-cache',
                'postman-token' => '8081f1ee-4445-4fd3-ab0e-1731eed0f239',
                'user-agent' => 'PostmanRuntime/7.1.1',
                'accept' => '*/*',
                'host' => 'localhost:8080',
                'accept-encoding' => 'gzip, deflate',
                'connection' => 'keep-alive',
            ],
            'server' => [
                'request_method' => 'GET',
                'request_uri' => '/',
                'path_info' => '/',
                'request_time' => 1518471991,
                'request_time_float' => 1518471992.58964,
                'server_port' => 8080,
                'remote_port' => 49849,
                'remote_addr' => '10.0.2.2',
                'master_time' => 1518471991,
                'server_protocol' => 'HTTP/1.1',
                'server_software' => 'swoole-http-server',
            ],
            'request' => NULL,
            'cookie' => [
                'Cookie_1' => 'value',
            ],
            'get' => NULL,
            'files' => NULL,
            'post' => NULL,
            'tmpfiles' => NULL,
        ];
    }
}
