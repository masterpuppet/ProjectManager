<?php

namespace Application\Mapper;

use Doctrine\Common\Persistence\ObjectRepository;
use Application\Entity\Task;

interface TaskMapperInterface extends ObjectRepository
{
    /**
     * @param Task $task
     * @return Task
     */
    public function create(Task $task);

    /**
     * @param Task $task
     * @return Task
     */
    public function update(Task $task);

    /**
     * @param Task $task
     * @return void
     */
    public function remove(Task $task);
}