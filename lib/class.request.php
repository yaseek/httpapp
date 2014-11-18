<?php
namespace Yaseek;

class Request {
    
    public function __construct() {
        $this->path = $_SERVER['REDIRECT_URL'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->query = $_REQUEST;

        if ( in_array($this->method, array('POST', 'PUT')) ) {
            $body = file_get_contents('php://input');
            if ($json = json_decode($body)) {
                $this->body = $json;
            } else {
                $this->body = $body;
            }
        }
    }
}