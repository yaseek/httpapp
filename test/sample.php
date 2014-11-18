<?php

require_once dirname(__DIR__) . '/lib/class.application.php';
require_once dirname(__DIR__) . '/lib/class.router.php';

$_SERVER['REDIRECT_URL'] = '/data/instagram';
$_SERVER['REQUEST_METHOD'] = 'GET';

$app = new Yaseek\HTTPApplication();

Yaseek\HTTPRouter::start($app, array('resources' => __DIR__ . '/resources'));
Yaseek\HTTPRouter::stop($app);
