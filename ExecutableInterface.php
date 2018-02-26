<?php

namespace FDevs\Executor;

interface ExecutableInterface
{
    /**
     * @param array $context
     *
     * @return ResultInterface
     */
    public function execute(array $context = []): ResultInterface;
}
