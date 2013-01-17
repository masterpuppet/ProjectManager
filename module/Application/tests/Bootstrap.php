<?php

use Zend\Mvc\Application;
use ApplicationTest\ServiceManagerTestCase;

chdir(__DIR__);

$previousDir = '.';

while (!file_exists('config/application.config.php')) {
    $dir = dirname(getcwd());

    if ($previousDir === $dir) {
        throw new RuntimeException(
            'Unable to locate "config/application.config.php":'
                . ' is ZfrForum in a sub-directory of your application skeleton?'
        );
    }

    $previousDir = $dir;
    chdir($dir);
}

switch (true){
    case file_exists(__DIR__ . '/../vendor/autoload.php'):
        $loader = include_once __DIR__ . '/../vendor/autoload.php';
        break;
    case file_exists(__DIR__ . '/../../../vendor/autoload.php'):
        $loader = include_once __DIR__ . '/../../../vendor/autoload.php';
        break;
    default:
        throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

$loader->add('ApplicationTest', __DIR__);

if (!$config = @include __DIR__ . '/TestConfiguration.php') {
    $config = require __DIR__ . '/TestConfiguration.php.dist';
}

ServiceManagerTestCase::setConfiguration($config);

$application    = Application::init(ServiceManagerTestCase::getConfiguration());
$serviceManager = $application->getServiceManager();

ServiceManagerTestCase::setServiceManager($serviceManager);

// Add some config for Doctrine

/** @var $moduleManager \Zend\ModuleManager\ModuleManager */
$moduleManager = $serviceManager->get('ModuleManager');
$serviceManager->setAllowOverride(true);

$config = $serviceManager->get('Config');

$config['doctrine']['connection']['orm_default'] = array(
    'configuration' => 'orm_default',
    'eventmanager'  => 'orm_default',
    'driverClass'   => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
    'params' => array(
        'memory' => true
    )
);

$serviceManager->setService('Config', $config);
