<?php

namespace FDevs\Executor;

interface ExecutableInterface
{
    /**
     * @param array $context    [`name` => value]
     *
     * @return ResultInterface
     */
    public function execute(array $context): ResultInterface;
}
