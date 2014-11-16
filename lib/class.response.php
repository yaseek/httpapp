<?php
namespace Yaseek;

class Response {
    public $finalized = false;
    
    public function send($code, $data) {
        $this->status($code);
        if (is_array($data) or is_object($data)) {
            echo json_encode($data) . PHP_EOL;
        } else {
            echo $data;
        }
        $this->finalized = true;
    }

    public function headers($data) {
        foreach ($data as $key => $value) {
            header(join(': ', array($key, $value)));
        }
    }
    
    public function status($code) {
        header("HTTP/1.0 ".$code);
    }
}