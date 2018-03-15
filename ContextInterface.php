<?php

namespace FDevs\Executor;

interface ContextInterface
{
    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getContext(string $name);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasContext(string $name): bool;

    /**
     * @param string $name
     * @param mixed       $value
     *
     * @return ContextInterface
     */
    public function addContext(string $name, $value): self;
}
