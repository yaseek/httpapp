<?php
namespace Yaseek;

class HTTPRouter {

    private function processResources($dir) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (strpos($file, '.') !== 0) {
                    if (filetype($dir . '/' . $file) === 'dir') {
                        $this->processResources($dir . '/' . $file);
                    } else {
                        include $dir . '/' . $file;
                    }
                }
            }
            closedir($dh);
        }
    }

    public function __construct($app, $options) {
        $resourceDir = $options['resources'];

        if (is_dir($resourceDir)) {
            $this->processResources($resourceDir);
        }
    }

}
