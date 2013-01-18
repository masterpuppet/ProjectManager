<?php
return array(
    'zfcrbac' => array(
		'firewallRoute' => true,
        'firewalls' => array(
            //'ZfcRbac\Firewall\Controller' => array(
            //    array('controller' => 'Application\Controller\Index', 'actions' => 'index', 'roles' => 'guest')
            //),
            'ZfcRbac\Firewall\Route' => array(
                array('route' => 'zfcuser/login', 'roles' => 'anonymous'),
                array('route' => 'zfcuser/logout', 'roles' => 'anonymous'),
                array('route' => 'zfcuser/register', 'roles' => 'anonymous'),
                array('route' => 'zfcuser', 'roles' => 'member'),
                array('route' => 'home', 'roles' => 'member'),
                array('route' => '/*', 'roles' => 'member'),
            ),
        ),
        'providers' => array(
            'ZfcRbac\Provider\Generic\Role\InMemory' => array(
			    'roles' => array(
                    'admin',
                    'member' => array('admin'),
                    'anonymous' => array('member'),
                ),
            ),
            'ZfcRbac\Provider\Generic\Permission\InMemory' => array(
				'permissions' => array('admin' => array('admin'))
            ),
        ),
        'identity_provider' => 'zfcuser_auth_service'
    )
);
