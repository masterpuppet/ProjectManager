<?php

namespace ApplicationTest\Entity;

use DateTime;
use PHPUnit_Framework_TestCase as TestCase;
use Application\Entity\Project;
use Application\Entity\Task;

class ProjectTest extends TestCase
{
    public function testProjectInitialCount()
    {
        $project = new Project();
        $this->assertEquals(0, count($project));
    }

    public function testProjectAddTasks()
    {
        $project = new Project();
		$project->addTask(new Task);
		$project->addTask(new Task);
		$project->addTask(new Task);
        $this->assertEquals(3, count($project));
    }

    public function testProjectRemoveTasks()
    {
        $project = new Project();
        $project->addTask(new Task);
        $t2 = new Task;
        $project->addTask($t2);
        $project->addTask(new Task);
        $project->removeTasks($t2);
        $this->assertEquals(2, count($project));
    }
}
