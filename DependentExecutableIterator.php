<?php

namespace FDevs\Executor;

use FDevs\Executor\Exception\CircularDependencyException;
use FDevs\Executor\Exception\ExecutableNotFoundException;
use FDevs\Executor\Exception\RuntimeException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;

class DependentExecutableIterator extends ServiceLocator implements DependentExecutableIteratorInterface
{
    /**
     * @var string[]
     */
    private $executableIds;

    /**
     * @var string[]
     */
    private $performedExecutables = [];

    /**
     * ExecutableIterator constructor.
     *
     * @param callable[] $executables
     */
    public function __construct(array $executables)
    {
        parent::__construct($executables);
        $this->executableIds = \array_keys($executables);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependenciesIterator(array $executableIds = []): \Iterator
    {
        $this->performedExecutables = [];

        if (empty($executableIds)) {
            $executableIds = $this->executableIds;
        }

        foreach ($executableIds as $id) {
            yield from $this->performExecutable($id);
        }
    }

    /**
     * @param string   $id              Identifier of FDevs\Executor\ExecutableInterface
     * @param string[] $dependencyTrace Array of dependent identifiers    [`id` => true]
     *
     * @throws CircularDependencyException
     * @throws ExecutableNotFoundException
     * @throws RuntimeException
     *
     * @return \Iterator    Iterator of FDevs\Fixture\Fixture\FixtureInterface
     */
    private function performExecutable(string $id, array $dependencyTrace = []): \Iterator
    {
        if (!isset($this->performedExecutables[$id])) {
            if (isset($dependencyTrace[$id])) {
                $trace = \array_keys($dependencyTrace);
                throw new CircularDependencyException($trace);
            }

            $fixture = $this->getExecutable($id);
            if ($fixture instanceof DependentExecutableInterface) {
                $dependencyTrace[$id] = true;
                foreach ($fixture->getDependencies() as $dependencyId) {
                    yield from $this->performExecutable($dependencyId, $dependencyTrace);
                }
            }

            $this->performedExecutables[$id] = true;
            yield $fixture;
        }
    }

    /**
     * @param string $id
     *
     * @throws ExecutableNotFoundException
     * @throws RuntimeException
     *
     * @return ExecutableInterface
     */
    private function getExecutable(string $id): ExecutableInterface
    {
        try {
            return $this->get($id);
        } catch (NotFoundExceptionInterface $e) {
            throw new ExecutableNotFoundException($e->getMessage());
        } catch (ContainerExceptionInterface $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
