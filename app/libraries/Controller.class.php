<?php
/*
 * Base Controller
 * load the models and views
 */

class Controller {

    //load model
    public function model($model){

        //require model
        require_once '../app/models' . $model . '.mod.php';

        //instantiate model
        return new $model();

    }

    //load view
    public function view($view){

        //require view
        require_once '../app/views/' . $view . 'vw.php';

        //instantiate view
        return new $view();

    }
}