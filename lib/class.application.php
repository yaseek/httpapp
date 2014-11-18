<?php
namespace Yaseek;

require_once __DIR__ . '/class.request.php';
require_once __DIR__ . '/class.response.php';

class HTTPApplication {

    public $request;
    public $response;
    
    public function __construct() {
        
        $this->request = new Request();
        $this->response = new Response();
        
    }

    private function matchExpression ($exp) {
        if (preg_match($exp, $this->request->path, $matches)) {
            $this->request->params = $matches;
            return TRUE;
        } else {
            $this->request->params = array();
            return FALSE;
        }
    }

    private function invoke ($handler) {
        $this->invocation = TRUE;
        if (is_array($handler) && count($handler) === 2) {
            $class = $handler[0];
            $method = $handler[1];
            $class::$method($this->request, $this->response);
        } else {
            $handler($this->request, $this->response);
        }
    }
    
    /*
    * $handler may me array(Class, static_method) or function name
    */
    public function get($exp, $handler) {
        if ( $this->request->method == 'GET' &&
                $this->matchExpression($exp)) {
            $this->invoke($handler);
        }
    }
    
    public function post($exp, $handler) {
        if ( $this->request->method == 'POST' &&
                $this->matchExpression($exp)) {
            $this->invoke($handler);
        }
    }
    
    public function put($exp, $handler) {
        if ( $this->request->method == 'PUT' &&
                $this->matchExpression($exp)) {
            $this->invoke($handler);
        }
    }
    
    public function delete($exp, $handler) {
        if ( $this->request->method == 'DELETE' &&
                $this->matchExpression($exp)) {
            $this->invoke($handler);
        }
    }
    
    public function head($exp, $handler) {
        if ( $this->request->method == 'HEAD' &&
                $this->matchExpression($exp)) {
            $this->invoke($handler);
        }
    }
    
}