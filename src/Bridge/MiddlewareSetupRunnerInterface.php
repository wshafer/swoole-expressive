<?php
declare(strict_types=1);

namespace WShafer\SwooleExpressive\Bridge;

use WShafer\SwooleExpressive\Exception\MissingPipeLineException;
use WShafer\SwooleExpressive\Exception\MissingRoutesException;

interface MiddlewareSetupRunnerInterface
{
    /**
     * @return boolean
     * @throws MissingPipeLineException
     * @throws MissingRoutesException
     */
    public function execute() : bool;
}
