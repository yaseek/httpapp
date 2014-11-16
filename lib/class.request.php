<?php
namespace Yaseek;

class Request {
    
    public function __construct() {
        $this->path = $_SERVER['REQUEST_URI'];
        $this->query = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
}