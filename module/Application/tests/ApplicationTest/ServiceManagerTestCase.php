<?php

namespace ApplicationTest;

use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit_Framework_TestCase as BaseTestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Application;

/**
 * Base test case to be used when a service manager instance is required
 */
class ServiceManagerTestCase extends BaseTestCase
{
    /**
     * @var array
     */
    private static $configuration = array();

    /**
     * @var ServiceManager
     */
    private static $serviceManager = null;

    /**
     * @var boolean
     */
    private static $hasDb = false;

    /**
     * Creates a database if not done already.
     */
    public function createDb()
    {
        if (self::$hasDb) {
            return;
        }

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = self::$serviceManager->get('Doctrine\ORM\EntityManager');
        $tool = new SchemaTool($em);
        $tool->updateSchema($em->getMetadataFactory()->getAllMetadata());
        self::$hasDb = true;
    }

    public function dropDb()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = self::$serviceManager->get('Doctrine\ORM\EntityManager');
        $tool = new SchemaTool($em);
        $tool->dropSchema($em->getMetadataFactory()->getAllMetadata());
        $em->clear();

        self::$hasDb = false;
    }

    /**
     * @static
     * @param array $configuration
     */
    public static function setConfiguration(array $configuration)
    {
        self::$configuration = $configuration;
    }

    /**
     * @static
     * @return array
     */
    public static function getConfiguration()
    {
        return self::$configuration;
    }

    /**
     * @param ServiceManager $serviceManager
     */
    public static function setServiceManager(ServiceManager $serviceManager)
    {
        self::$serviceManager = $serviceManager;
    }

    /**
     * @static
     * @return null|ServiceManager
     */
    public static function getServiceManager()
    {
        return self::$serviceManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return self::$serviceManager->get('Doctrine\ORM\EntityManager');
    }
}

