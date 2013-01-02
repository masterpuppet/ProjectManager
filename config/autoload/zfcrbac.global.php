<?php
return array(
    'zfcrbac' => array(
		'firewallRoute' => true,
        'firewalls' => array(
            //'ZfcRbac\Firewall\Controller' => array(
            //    array('controller' => 'Application\Controller\Index', 'actions' => 'index', 'roles' => 'guest')
            //),
            'ZfcRbac\Firewall\Route' => array(
                array('route' => 'profiles/add', 'roles' => 'member'),
                array('route' => 'admin/*', 'roles' => 'admin')
            ),
        ),
        'providers' => array(
            'ZfcRbac\Provider\Generic\Role\InMemory' => array(
				'roles' => array('anonymous', 'member', 'admin')
            ),
            'ZfcRbac\Provider\Generic\Permission\InMemory' => array(
				'permissions' => array('admin' => array('admin'))                
            ),
        ),
        'identity_provider' => 'zfcuser_auth_service'
    )
);
