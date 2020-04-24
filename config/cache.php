<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Cache\Frontend\Data as FrontendData;
use Phalcon\Cache\Backend\Redis as BackendRedis;
use Phalcon\Mvc\Model\MetaData\Redis as RedisMetaData;
use Phalcon\Session\Adapter\Redis as Session;

// Set the models cache service
$di->set(
    'modelsCache',
    function () {
        $config = $this->getConfig();

        // Cache data for one day (default setting)
        $frontCache = new FrontendData(
            [
                'lifetime' => 3600,
            ]
        );

        // Memcached connection settings
        $cache = new BackendRedis(
            $frontCache,
            [
                'host' => $config->redis->host,
                'port' => $config->redis->port,
                "auth" => $config->redis->auth,
                "persistent" => false,
                "index"      => 0,
            ]
        );

        return $cache;
    }
);

// Create a metadata manager with Redis
$di->set(
    'modelsMetadata',
    function () {
        $config = $this->getConfig();

        $metadata = new RedisMetaData(
            [
                'host' => $config->redis->host,
                'port' => $config->redis->port,
                "auth" => $config->redis->auth,
                'lifetime' => 3600,
            ]
        );

        return $metadata;
    }
);
// Set Redis as session handler
$di->setShared(
    'session',
    function () {
        $config = $this->getConfig();

        $session = new Session(
            [
                "uniqueId"   => $config->appuniqid,
                "host"       => $config->redis->host,
                "port"       => $config->redis->port,
                "auth"       => $config->redis->auth,
                "persistent" => false,
                "lifetime"   => 7200,
                "prefix"     => $config->appuniqid,
                "index"      => 1,
            ]);

        $session->start();

        return $session;
    }
);

