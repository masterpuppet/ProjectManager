<?php

namespace Application\Mapper;

use Doctrine\Common\Persistence\ObjectRepository;
use Application\Entity\Project;

interface ProjectMapperInterface extends ObjectRepository
{
    /**
     * @param Project $project
     * @return Project
     */
    public function create(Project $project);

    /**
     * @param Project $project
     * @return Project
     */
    public function update(Project $project);

    /**
     * @param Project $project
     * @return void
     */
    public function remove(Project $project);
}