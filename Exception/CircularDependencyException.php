<?php

namespace FDevs\Executor\Exception;

class CircularDependencyException extends RuntimeException
{
    /**
     * CircularDependencyException constructor.
     *
     * @param string[] $dependencyTrace
     */
    public function __construct(array $dependencyTrace)
    {
        $msg = 'Circular dependencies detected for trace "' . \implode('" -> "', $dependencyTrace) . '"';
        parent::__construct($msg);
    }
}
