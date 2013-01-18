<?php

namespace Application\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Model\TaskInterface;
use Application\Model\ProjectInterface;
use DateTime;
use ZfcUserDoctrineORM\Entity\User as BaseUser;
use ZfcRbac\Identity\IdentityInterface;

class User extends BaseUser implements IdentityInterface
{
    /**
     * @var Collection
     */
    protected $owns;

    /**
     * @var Collection
     */
    protected $belongs;

    /**
     * @var Collection
     */
    protected $createdTasks;

    /**
     * @var Collection
     */
    protected $tasks;

    public function __construct()
    {
        $this->owns    = new ArrayCollection;
        $this->belongs = new ArrayCollection;
        $this->tasks   = new ArrayCollection;
        $this->createdTasks = new ArrayCollection;
    }

    public function addOwns(ProjectInterface $project)
    {
        $this->owns[] = $project;
    }

    public function getOwns()
    {
        return $this->owns;
    }

    public function addBelong(ProjectInterface $project)
    {
        $this->belongs[] = $project;
    }

    public function getBelongs()
    {
        return $this->belongs;
    }

    public function addCreatedTask(TaskInterface $task)
    {
        $this->createdTasks[] = $task;
    }

    public function getCreatedTasks()
    {
        return $this->createdTasks;
    }

    public function addTask(TaskInterface $task)
    {
        $this->tasks[] = $task;
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @todo create real getRoles
     */
    public function getRoles()
    {
        return array('admin');
    }
}