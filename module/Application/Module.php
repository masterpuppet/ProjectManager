<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{

    public function onBootstrap($e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach('dispatch.error', function($e) use ($eventManager) {
            if ($e->isError() && $e->getError() == 'error-route-unauthorized') {
                $roles = $e->getParam('identity')->getRoles();
                if ($roles[0] == 'anonymous') {
                    $router = $e->getRouter();
                    $url    = $router->assemble(array(), array('name' => 'zfcuser/login'));
                    $response = $e->getResponse();
                    $response->setStatusCode(302);
                    //redirect to login route...
                    $response->getHeaders()->addHeaderLine('Location', $url);
                }
            }
        });

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            /**
             * Factories
             */
            'factories' => array(
                'Application\Service\ProjectService' => function($serviceManager) {
                    $projectMapper = $serviceManager->get('Application\Mapper\ProjectMapperInterface');
                    return new Service\ProjectService($projectMapper);
                },
                'Application\Service\TaskService' => function($serviceManager) {
                    $taskMapper = $serviceManager->get('Application\Mapper\TaskMapperInterface');
                    return new Service\TaskService($taskMapper);
                },
            ),
            /**
             * Abstract factories
             */
            'abstract_factories' => array(
                'Application\ServiceFactory\MapperAbstractFactory'
            )
        );
    }
}
