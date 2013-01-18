<?php

namespace Application\Service;

use Application\Entity\Project;
use Application\Mapper\ProjectMapperInterface;

class ProjectService
{

    /**
     * @var ProjectMapperInterface
     */
    protected $projectMapper;

    /**
     * @param ProjectMapperInterface $projectMapper
     */
    public function __construct(ProjectMapperInterface $projectMapper)
    {
        $this->projectMapper = $projectMapper;
    }

    /**
     * Create a new Project
     *
     * @param  Project $project
     * @throws Exception\DomainException
     * @return project
     */
    public function create(Project $project)
    {
        if ($project->getName() === '' || $project->getName() === null) {
            throw new Exception\DomainException('A Project must have a name, but none was given');
        }

        return $this->projectMapper->create($project);
    }

    /**
     * Update an existing Project
     *
     * @param Project $project
     * @return Project
     */
    public function update(Project $project)
    {
        return $this->projectMapper->update($project);
    }

    /**
     * Remove an existing Project
     *
     * @param Project $project
     * @return void
     */
    public function remove(Project $project)
    {
        $this->projectMapper->remove($project);
    }
}