<?php

namespace FDevs\Executor;

class Executor implements ExecutorInterface
{
    /**
     * @var DependentExecutableIteratorInterface
     */
    private $iterator;

    /**
     * Executor constructor.
     *
     * @param DependentExecutableIteratorInterface $iterator
     */
    public function __construct(DependentExecutableIteratorInterface $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(ContextInterface $context, array $executables = []): \Iterator
    {
        $iterator = $this->iterator->getDependenciesIterator($executables);
        foreach ($iterator as $executable) {
            yield $executable->execute($context);
        }
    }
}
