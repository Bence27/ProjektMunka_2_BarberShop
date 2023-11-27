<?php
    spl_autoload_register(function($class)
    {
        include 'PHP/classes/' . $class . '.class.php';
    });

    $route = new Route($_SERVER["REQUEST_URI"]);
    $route -> urlRoute();
?>