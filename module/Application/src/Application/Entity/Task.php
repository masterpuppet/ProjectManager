<?php

namespace Application\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Model\CommentInterface;
use Application\Model\TaskInterface;
use Application\Model\MediaInterface;
use Application\Model\UserInterface;
use Application\Model\ProjectInterface;
use DateTime;

class Task implements TaskInterface
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
	protected $createdBy;

	/**	 
	 * @var Collection
	 */
	protected $assignedTo;

	/**	 
	 * @var Collection
	 */	
	protected $comments;

	/**	 
	 * @var Collection
	 */	
	protected $media;

    /**     
     * @var Project
     */
    protected $project;

	/**
	 * @return Task
	 */
	public function __construct()
	{
		$this->setCreatedAt(new DateTime);
		$this->assignedTo = new ArrayCollection;
		$this->comments   = new ArrayCollection;
		$this->media      = new ArrayCollection;
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

    public function setCreatedBy(UserInterface $createdBy)
    {       
        $this->createdBy = $createdBy;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setAssignedTo($assignedTo)
    {
        $this->assignedTo->clear();
        foreach ($assignedTo as $assigned) {
            $this->addAssignedTo($assigned);
        }
    }

    public function addAssignedTo(UserInterface $assignedTo)
    {
        $this->assignedTo[] = $assignedTo;
    }

    public function removeAssignedTo(UserInterface $assignedTo)
    {
        $this->assignedTo->removeElement($assignedTo);
    }

    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

	public function setComments($comments)
    {
        $this->comments->clear();
        foreach ($comments as $comment) {
            $this->addComment($comment);
        }
    }

    public function addComment(CommentInterface $comment)
    {
        $this->comments[] = $comment;
    }

    public function removeComment(CommentInterface $comment)
    {
        $this->comments->removeElement($comment);
    }

    public function getComments()
    {
        return $this->comments;
    }

	public function setMedia($media)
    {
        $this->media->clear();
        foreach ($media as $m) {
            $this->addMedia($m);
        }
    }

    public function addMedia(MediaInterface $media)
    {
        $this->media[] = $media;
    }

    public function removeMedia(MediaInterface $media)
    {
        $this->media->removeElement($media);
    }

    public function getMedia()
    {
        return $this->media;
    }    

    public function setProject(ProjectInterface $project)
    {
        $this->project = $project;
    }

    public function getProject()
    {
        return $this->project;
    }
}