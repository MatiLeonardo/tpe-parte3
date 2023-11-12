<?php

include_once 'libs/Router.php';
include_once 'app/controllers/ArtistaApiController.php';

$router = new Router();
#                 recurso         verbo   controller               metodo
$router->addRoute('artistas'    , 'GET' , 'ArtistaApiController', 'get'    );
$router->addRoute('artistas'    , 'POST', 'ArtistaApiController', 'agregar');
$router->addRoute('artistas/:ID', 'GET' , 'ArtistaApiController', 'get'    );
$router->addRoute('artistas/:ID', 'DELETE', 'ArtistaApiController' , 'delete'); 
$router->addRoute('artistas/:ID', 'PUT', 'ArtistaApiController', 'update');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
