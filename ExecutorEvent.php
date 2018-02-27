<?php

namespace FDevs\Executor;

use Symfony\Component\EventDispatcher\Event;

class ExecutorEvent extends Event
{
    /**
     * @var array
     */
    private $context;

    /**
     * LoadEvent constructor.
     *
     * @param array $context
     */
    public function __construct(array $context)
    {
        $this->context = $context;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
