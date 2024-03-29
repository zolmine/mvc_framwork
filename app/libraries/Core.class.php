<?php

    /*
     * App Core Class
     * Creates Url & loads Core controller
     * URL Format - /controller/method/params
     */

    class Core
    {

        protected  $currentController = 'pages';
        protected  $currentMethod = 'index';
        protected array $params = [];

        public function __construct()
        {

            //print_r($this->getUrl());
            $url = $this->getUrl();

            //look in controllers for first value
            if (file_exists('../app/controllers/' . ucwords($url[0] . '.class.php'))) {
                //if exists , set as a controller
                $this->currentController = ucwords($url[0]);
                //unset 0 index
                unset($url[0]);
            }

            //require the controller
            require_once '../app/controllers/' . $this->currentController . '.class.php';

            //instantiate controller class
            $this->currentController = new $this->currentController;

            //check the second part of url
            if (isset($url[1])){

                //check to see if the method exist in controller
                if (method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];

                    //unset params index 1
                    unset($url[1]);
                }
            }

            //get params
            $this->params = $url ? array_values($url) : [];

            //call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(): array
        {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }