<?php

namespace FDevs\Executor;

class ArrayContext extends \ArrayIterator implements ContextInterface
{
    /**
     * @inheritDoc
     */
    public function getContext(string $name)
    {
        return $this->offsetGet($name);
    }

    /**
     * @inheritDoc
     */
    public function hasContext(string $name): bool
    {
        return $this->offsetExists($name);
    }

    /**
     * @inheritDoc
     */
    public function addContext(string $name, $value): ContextInterface
    {
        $this->offsetSet($name, $value);

        return $this;
    }
}
