<?php

include_once 'libs/Router.php';

$router->addRoute('artistas', 'GET', 'ArtistaApiController', 'get');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
