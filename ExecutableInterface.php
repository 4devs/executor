<?php

namespace FDevs\Executor;

interface ExecutableInterface
{
    /**
     * @param ContextInterface $context
     *
     * @return ResultInterface
     */
    public function execute(ContextInterface $context): ResultInterface;
}
