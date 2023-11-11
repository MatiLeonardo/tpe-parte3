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
}