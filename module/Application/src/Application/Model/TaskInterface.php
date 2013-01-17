<?php

namespace Application\Model;

use DateTime;

interface TaskInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getdescription();   

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt);

    /**
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * @param UserInterface $user
     */
    public function setCreatedBy(UserInterface $user);

    /**
     * @return UserInterface
     */
    public function getCreatedBy();

    /**
     * $param mixed $assignedTo
     */
    public function setAssignedTo($assignedTo);

    /**
     * @param UserInterface $assignedTo
     */
    public function addAssignedTo(UserInterface $assignedTo);

    /**
     * @param UserInterface $assignedTo
     */
    public function removeAssignedTo(UserInterface $assignedTo);

    /**
     * @return mixed 
     */
    public function getAssignedTo();

    /**
     * @param mixed $comments
     */
    public function setComments($comments);

    /**
     * @param CommentInterface $comment
     */
    public function addComment(CommentInterface $comment);

    /**
     * @param CommentInterface $comment
     */     
    public function removeComment(CommentInterface $comment);

    /**
     * @return mixed
     */     
    public function getComments();

    /**
     * @param mixed $media
     */
    public function setMedia($media);

    /**
     * @param MediaInterface $media
     */
    public function addMedia(MediaInterface $media);

    /**
     * @param MediaInterface $media
     */     
    public function removeMedia(MediaInterface $media);

    /**
     * @return mixed
     */     
    public function getMedia();     
}