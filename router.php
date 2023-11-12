<?php

include_once 'libs/Router.php';
include_once 'app/controllers/ArtistaApiController.php';

$router = new Router();
#                 recurso         verbo   controller               metodo
$router->addRoute('artistas'    , 'GET' , 'ArtistaApiController', 'get'    );
$router->addRoute('artistas'    , 'POST', 'ArtistaApiController', 'agregar');
$router->addRoute('artistas/:ID', 'GET' , 'ArtistaApiController', 'get'    );

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
