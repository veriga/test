<?php
class server_a
{
    public $request_uri;
    public $ip;
    public $document_root;
    public $http_host;
    public $http_user_agent;
    public $query_string;

    public function __construct($_SERVER)
    {
        $this->request_uri = $_SERVER['REQUEST_URI'];
        $this->ip = $_SERVER['SERVER_ADDR'];
        $this->document_root = $_SERVER['DOCUMENT_ROOT'];
        $this->http_host = $_SERVER['HTTP_HOST'];
        $this->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->query_string = $_SERVER['QUERY_STRING'];
    }

    public function print_server()
    {
        echo 'request_uri: ' . $this->request_uri . "<br/>";
        echo 'ip: ' . $this->ip . "<br/>";
        echo 'document_root:' . $this->document_root . "<br/>";
        echo 'http_host: ' . $this->http_host . "<br/>";
        echo 'http_user_agent: ' . $this->http_user_agent . "<br/>";
        echo 'query_string: ' .  $this->query_string . "<br/>";
    }
}

$array = new server_a($_SERVER);
$array->print_server();