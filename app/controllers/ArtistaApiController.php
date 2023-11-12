<?php
include_once './app/controllers/ApiController.php';
include_once './app/models/ArtistaApiModel.php';
include_once './app/views/APIview.php';

class ArtistaApiController extends ApiController
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ArtistaApiModel();
    }

    public function get($params = []){
        if(empty($params)){
            $artistas = $this->model->getArtistas();
            $this->view->response($artistas, 200);
        }
        else {
            $artista = $this->model->getArtista($params[":ID"]);
            if(!empty($artista)) {
                $this->view->response($artista,200);
            }
            else {
                $this->view->response('El artista con el id='.$params[':ID'].' no existe.', 404);
            }

        }
      
    }

    public function agregar(){
        $body = $this->getData();     
        
        $nombre = $body->nombre;
        $descripcion = $body->descripcion;
        $edad = $body->$edad;
        $nacionalidad = $body->nacionalidad;
        $oyentes = $body->oyentes;
        
        $existe = $this->model->getArtistaName($nombre);
        if(empty($existe)){
            $id = $this->model->addArtista($nombre, $descripcion, $edad, $nacionalidad, $oyentes);
            $artista = $this->model->getArtista($id);
            $this->view->response($artista, 201);
        }
        else {
            $this->view->response('El artista '.$nombre.' ya existe.', 400);
        }
        

    }
}