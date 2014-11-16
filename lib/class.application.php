<?php
namespace Yaseek;

require_once __DIR__ . '/class.request.php';
require_once __DIR__ . '/class.response.php';

class HTTPApplication {
    
    public function __construct() {
        
        $this->request = new Request();
        $this->response = new Response();
        
    }
    
    public function get($exp, $class) {
        if (!$this->response->finalized and $this->request->method == 'GET') {
            if (preg_match($exp, $this->request->path, $matches)) {
                $this->request->params = $matches;
                new $class($this->request, $this->response);
            }
        }
    }
    
}