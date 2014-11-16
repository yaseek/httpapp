<?php

require_once dirname(__DIR__) . '/lib/class.application.php';
require_once dirname(__DIR__) . '/lib/class.router.php';

$_SERVER['REQUEST_URI'] = '/data/instagram';
$_SERVER['REQUEST_METHOD'] = 'GET';

$app = new Yaseek\HTTPApplication();
$router = new Yaseek\HTTPRouter($app, array('resources' => __DIR__ . '/resources'));