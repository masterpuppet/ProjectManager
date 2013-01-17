<?php

namespace Application\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Model\ProjectInterface;
use Application\Model\TaskInterface;
use Application\Model\UserInterface;
use Countable;
use DateTime;

class Project implements ProjectInterface, Countable

{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var UserInterface
     */
    protected $owner;

    /**
     * @todo LAZY
     * @var Collection
     */
    protected $members;

    /**
     * @todo LAZY
     * @var Collection
     */
    protected $tasks;

    /**
     * @return Project
     */
    public function __construct()
    {
        $this->setCreatedAt(new DateTime);
        $this->members = new ArrayCollection;
        $this->tasks   = new ArrayCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = (string)$name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = clone $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setOwner(UserInterface $user)
    {
        $this->addMember($user);
        $this->owner = $user;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setMembers($members)
    {
        $this->members->clear();
        foreach ($members as $member) {
            $this->addMember($member);
        }
    }

    public function addMember(UserInterface $member)
    {
        $this->members[] = $member;
    }

    public function removeMember(UserInterface $member)
    {
        $this->members->removeElement($member);
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function setTasks($tasks)
    {
        $this->tasks->clear();
        foreach ($tasks as $task) {
            $this->addTask($task);
        }
    }

    public function addTask(TaskInterface $task)
    {
        $this->tasks[] = $task;
    }

    public function removeTask(TaskInterface $task)
    {
        $this->tasks->removeElement($task);
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function count()
    {
        return count($this->getTasks());
    }

}