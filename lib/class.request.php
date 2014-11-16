<?php
namespace Yaseek;

class Request {
    
    public function __construct() {
        $this->path = $_SERVER['REDIRECT_URL'];
        $this->query = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
}