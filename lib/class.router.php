<?php
namespace Yaseek;

class HTTPRouter {

    private static function processResources($dir) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (strpos($file, '.') !== 0) {
                    if (filetype($dir . '/' . $file) === 'dir') {
                        self::processResources($dir . '/' . $file);
                    } else {
                        include $dir . '/' . $file;
                    }
                }
            }
            closedir($dh);
        }
    }

    public static function start($app, $options) {
        $resourceDir = $options['resources'];

        if (is_dir($resourceDir)) {
            self::processResources($resourceDir);
        }
    }

    public static function stop($app, $status = 404, $dir = NULL) {
        if (!$app->invoked()) {
            $app->response->status($status);
            if (!$dir) {
                $dir = dirname( __DIR__ ) . '/view';
            }
            include $dir . '/' . $status . '.php';
        }
    }
}
