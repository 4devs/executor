<?php

namespace FDevs\Executor;

interface DependentExecutableInterface
{
    /**
     * @return array    Array of executable identifiers dependencies
     */
    public function getDependencies(): array;
}
