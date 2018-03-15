<?php

namespace FDevs\Executor;

use FDevs\Executor\Exception\CircularDependencyException;
use FDevs\Executor\Exception\ExecutableNotFoundException;
use FDevs\Executor\Exception\RuntimeException;

interface ExecutorInterface
{
    /**
     * @param ContextInterface $context
     * @param array $executables    Executable identifiers to execute
     *
     * @throws CircularDependencyException
     * @throws ExecutableNotFoundException
     * @throws RuntimeException
     *
     * @return \Iterator|ResultInterface[]    Iterator of FDevs\Executor\ResultInterface
     */
    public function execute(ContextInterface $context, array $executables = []): \Iterator;
}
