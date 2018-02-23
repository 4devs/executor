<?php

namespace FDevs\Executor;

use FDevs\Executor\Exception\CircularDependencyException;
use FDevs\Executor\Exception\ExecutableNotFoundException;
use FDevs\Executor\Exception\RuntimeException;

interface DependentExecutableIteratorInterface
{
    /**
     * Return all executables with their resolved dependencies
     *
     * @param array $executableIds  Identifier of executables to iterate
     *
     * @throws CircularDependencyException
     * @throws ExecutableNotFoundException
     * @throws RuntimeException
     *
     * @return \Iterator|ExecutableInterface[]    Iterator of FDevs\Executor\ExecutableInterface
     */
    public function getDependenciesIterator(array $executableIds = []): \Iterator;
}
