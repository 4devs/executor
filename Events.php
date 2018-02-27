<?php

namespace FDevs\Executor;

final class Events
{
    /**
     * The EXECUTOR_BEGIN event occurs at the begin of FDevs\Executor\Executor::execute().
     *
     * The event listener method receives a FDevs\Executor\ExecutorEvent instance.
     *
     * @Event
     *
     * @var string
     */
    public const EXECUTOR_BEGIN = 'f_devs.executor.event.executor_begin';

    /**
     * The EXECUTOR_END event occurs at the end of FDevs\Executor\Executor::execute().
     *
     * The event listener method receives a FDevs\Executor\ExecutorEvent instance.
     *
     * @Event
     *
     * @var string
     */
    public const EXECUTOR_END = 'f_devs.executor.event.executor_end';
}
