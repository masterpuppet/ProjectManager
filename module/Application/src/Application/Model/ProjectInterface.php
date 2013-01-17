<?php

namespace Application\Model;

use DateTime;

interface ProjectInterface
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
 	public function setOwner(UserInterface $user);

 	/**
 	 * @return UserInterface
 	 */
 	public function getOwner();

 	/**
 	 * $param mixed $members
 	 */
 	public function setMembers($members);

 	/**
 	 * @param UserInterface $member
 	 */
 	public function addMember(UserInterface $member);

 	/**
 	 * @param UserInterface $member
 	 */
 	public function removeMember(UserInterface $member);

 	/**
 	 * @return mixed 
 	 */
 	public function getMembers();

 	/**
 	 * $param mixed $tasks
 	 */
 	public function setTasks($tasks);

 	/**
 	 * @param TaskInterface $task
 	 */
 	public function addTask(TaskInterface $task);

 	/**
 	 * @param TaskInterface $task
 	 */
 	public function removeTask(TaskInterface $task);

 	/**
 	 * @return mixed 
 	 */
 	public function getTasks();

}