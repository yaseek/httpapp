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

    public static function stop($app) {
        if (!isset($app->invocation)) {
            $app->response->status(404);
            include dirname( __DIR__ ) . '/view/404.php';
        }
    }
}
