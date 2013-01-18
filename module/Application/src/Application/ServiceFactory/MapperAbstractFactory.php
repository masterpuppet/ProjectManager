<?php

namespace Application\ServiceFactory;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MapperAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return (substr($requestedName, -15) === 'MapperInterface');
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        // Mapper names given are under the form "Application\Mapper\SomethingMapperInterface", so we need to
        // remove the MapperInterface part
        $parts       = explode('\\', $requestedName);
        $entityName  = substr(end($parts), 0, -15);
        $entityClass = 'Application\\Entity\\' . $entityName;

        return $entityManager->getRepository($entityClass);
    }
}