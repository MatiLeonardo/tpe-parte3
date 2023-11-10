<?php

include_once './app/models/ArtistaApiModel.php';
include_once './app/views/APIview.php';

class ArtistaApiController
{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new ArtistaApiModel();
        $this->view = new ApiView();
    }

    public function get($params = []){
        if(empty($params)){
            $artistas = $this->model->getArtistas();
            return $this->view->response($artistas, 200);
        }
    }
}