<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;

class Module
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
}
