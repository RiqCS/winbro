<?php

class App {
    protected $controller = 'Master';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if($url == NULL){
            $url[0] = 'Master';
        }
        
        // Controllers
        if(file_exists('app/controllers/' . $url[0] . '.php')){
            $this->controller = $url[0];
            unset($url[0]);
        }

        // var_dump($url);echo"<br>";

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }  
        
        // parameter
        if(! empty($url)){
            $this->params = array_values($url);
        } 

        // var_dump($url);echo"<br>";
        // var_dump($this->params);
        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    public function parseURL()
    {
         if(isset($_GET['url'])){
             $url = rtrim($_GET['url'],'/');
             $url = filter_var($url,FILTER_SANITIZE_URL);
             $url = explode('/', $url);
             return $url;
         }
    }
}