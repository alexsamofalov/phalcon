<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Acl;

//Create the ACL
$acl = new AclList();

//The default action is DENY access
$acl->setDefaultAction(Acl::DENY);

//Create roles
$acl->addRole(new Role(\System\User::roleGuest));
$acl->addRole(new Role(\System\User::roleUser));

// Set acl rules
$arrResources = [
    \System\User::roleGuest=>[
        \System\ApiControllers\IndexController::class=>['index'],
        \System\ApiControllers\AuthController::class=>['login']
    ],
    \System\User::roleUser=>[
        \System\ApiControllers\AuthController::class=>['logout']
    ]
];

// create resources
foreach($arrResources as $arrResource){
    foreach($arrResource as $controller=>$arrMethods){
        $acl->addResource(new Resource($controller),$arrMethods);
    }
}

// set access
foreach ($acl->getRoles() as $objRole) {
    $roleName = $objRole->getName();

    //everyone gets access to global resources
    foreach ($arrResources[\System\User::roleGuest] as $resource => $method) {
        $acl->allow($roleName,$resource,$method);
    }

    // set role based access
    if($roleName != \System\User::roleGuest){
        foreach ($arrResources[$roleName] as $resource => $method) {
            $acl->allow($roleName,$resource,$method);
        }
    }
}


