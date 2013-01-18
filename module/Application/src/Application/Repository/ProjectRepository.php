<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Project;
use Application\Mapper\ProjectMapperInterface;

class ProjectRepository extends EntityRepository implements ProjectMapperInterface
{
    /**
     * Create the Project
     *
     * @param  Project $project
     * @return Project
     */
    public function create(Project $project)
    {
        $this->_em->persist($project);
        $this->_em->flush($project);

        return $project;
    }

    /**
     * Update the Project
     *
     * @param  Project $project
     * @return project
     */
    public function update(Project $project)
    {
        $this->_em->flush($project);
        return $project;
    }

    /**
     * Remove the Project
     *
     * @param  Project $project
     * @return void
     */
    public function remove(Project $project)
    {
        $this->_em->remove($project);
        $this->_em->flush($project);
    }
}