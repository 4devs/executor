<?php

namespace FDevs\Executor;

use FDevs\Executor\Exception\CircularDependencyException;
use FDevs\Executor\Exception\ExecutableNotFoundException;
use FDevs\Executor\Exception\RuntimeException;

interface ExecutorInterface
{
    /**
     * @param array $context
     *
     * @throws CircularDependencyException
     * @throws ExecutableNotFoundException
     * @throws RuntimeException
     *
     * @return \Iterator    Iterator of FDevs\Executor\ResultInterface
     */
    public function execute(array $context = []): \Iterator;
}
