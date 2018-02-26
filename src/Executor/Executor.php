<?php

namespace FDevs\Executor;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Executor implements ExecutorInterface
{
    public const CONTEXT_EXECUTABLES_IDS = 'executables';

    /**
     * @var DependentExecutableIteratorInterface
     */
    private $iterator;
    /**
     * @var null|EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * Executor constructor.
     *
     * @param DependentExecutableIteratorInterface $iterator
     * @param EventDispatcherInterface|null        $dispatcher
     */
    public function __construct(DependentExecutableIteratorInterface $iterator, EventDispatcherInterface $dispatcher = null)
    {
        $this->iterator = $iterator;
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $context = []): \Iterator
    {
        $this->dispatchIfPossible(Events::EXECUTOR_BEGIN, $this->createExecutorEvent($context));

        $executableIds = $context[self::CONTEXT_EXECUTABLES_IDS] ?? [];
        $executables = $this->iterator->getDependenciesIterator($executableIds);
        foreach ($executables as $executable) {
            yield $executable->execute($context);
        }

        $this->dispatchIfPossible(Events::EXECUTOR_END, $this->createExecutorEvent($context));
    }

    /**
     * @param string $eventName
     * @param Event  $event
     *
     * @return Executor
     */
    private function dispatchIfPossible(string $eventName, Event $event): self
    {
        if (null !== $this->dispatcher) {
            $this->dispatcher->dispatch($eventName, $event);
        }
        return $this;
    }

    /**
     * @param array $context
     *
     * @return ExecutorEvent
     */
    private function createExecutorEvent(array $context): ExecutorEvent
    {
        return new ExecutorEvent($context);
    }
}
