<?php

spl_autoload_register(function ($class_name){

    $full_path = 'libraries/' . $class_name . '.class.php';

    require_once $full_path;

});

