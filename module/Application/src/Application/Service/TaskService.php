<?php

namespace Application\Service;

use Application\Entity\Task;
use Application\Mapper\TaskMapperInterface;

class TaskService
{

    /**
     * @var TaskMapperInterface
     */
    protected $taskMapper;

    /**
     * @param TaskMapperInterface $taskMapper
     */
    public function __construct(TaskMapperInterface $taskMapper)
    {
        $this->taskMapper = $taskMapper;
    }

    /**
     * Create a new Task
     *
     * @param  Task $task
     * @throws Exception\DomainException
     * @return Task
     */
    public function create(Task $task)
    {
        if ($task->getName() === '' || $task->getName() === null) {
            throw new Exception\DomainException('A Task must have a name, but none was given');
        }

        return $this->taskMapper->create($task);
    }

    /**
     * Update an existing Task
     *
     * @param Task $task
     * @return Task
     */
    public function update(Task $task)
    {
        return $this->taskMapper->update($task);
    }

    /**
     * Remove an existing Task
     *
     * @param Task $task
     * @return void
     */
    public function remove(Task $task)
    {
        $this->taskMapper->remove($task);
    }
}