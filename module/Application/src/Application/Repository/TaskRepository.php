<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Task;
use Application\Mapper\TaskMapperInterface;

class TaskRepository extends EntityRepository implements TaskMapperInterface
{
    /**
     * Create the Task
     *
     * @param  Task $task
     * @return Task
     */
    public function create(Task $task)
    {
        $this->_em->persist($task);
        $this->_em->flush($task);

        return $Task;
    }

    /**
     * Update the Task
     *
     * @param  Task $task
     * @return Task
     */
    public function update(Task $task)
    {
        $this->_em->flush($task);
        return $task;
    }

    /**
     * Remove the Task
     *
     * @param  Task $task
     * @return void
     */
    public function remove(Task $task)
    {
        $this->_em->remove($task);
        $this->_em->flush($task);
    }
}