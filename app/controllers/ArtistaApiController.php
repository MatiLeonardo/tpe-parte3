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

    public function get($params = [])
    {
        if (empty($params)) {
            $artistas = $this->model->getArtistas();
            $this->view->response($artistas, 200);
        } else {
            $artista = $this->model->getArtista($params[":ID"]);
            if (!empty($artista)) {
                $this->view->response($artista, 200);
            } else {
                $this->view->response('El artista con el id=' . $params[':ID'] . ' no existe.', 404);
            }

        }

    }

    public function agregar()
    {
        $body = $this->getData();

        $nombre = $body->nombre;
        $descripcion = $body->descripcion;
        $edad = $body->edad;
        $nacionalidad = $body->nacionalidad;
        $oyentes = $body->cant_oyentes;

        $existe = $this->model->getArtistaName($nombre);
        if (empty($existe)) {
            $id = $this->model->addArtista($nombre, $descripcion, $edad, $nacionalidad, $oyentes);
            $artista = $this->model->getArtista($id);
            $this->view->response($artista, 201);
        } else {
            $this->view->response('El artista ' . $nombre . ' ya existe.', 400);
        }


    }

    public function update($params = [])
    {
        $id = $params[':ID'];

        if (empty($id)) {
            $this->view->response("No se ha proporcionado un ID", 400);
        }

        $body = $this->getData();
        if (empty($body->nombre) || empty($body->descripcion) || empty($body->edad) || empty($body->nacionalidad) || empty($body->cant_oyentes)) {
            $this->view->response("Falta ingresar algún dato", 400);
        } else {
            $nombre = $body->nombre;
            $descripcion = $body->descripcion;
            $edad = $body->edad;
            $nacionalidad = $body->nacionalidad;
            $cant_oyentes = $body->cant_oyentes;
        }


        $artista = $this->model->getArtista($id);

        if ($artista) {

            if ($this->model->updateArtista($nombre, $descripcion, $edad, $nacionalidad, $cant_oyentes, $id)) {
                $this->view->response("Artista actualizado con éxito", 200);
            } else {
                $this->view->response("Error al actualizar el artista", 500);
            }

        } else {
            $this->view->response("El artista ID: $id no existe", 404);
        }



    }

    public function delete($params = [])
    {
        $id = $params[':ID'];

        if (empty($id)) {
            $this->view->response("No se ha proporcionado un ID", 400);
        }

        $cancionesArtista = $this->model->getCancionesArtista($id);
        if (empty($cancionesArtista)) {

            $artista = $this->model->getArtista($id);
            if ($artista) {

                if ($this->model->deleteArtista($id)) {
                    $this->view->response("Artista ID: $id eliminado con éxito", 200);
                } else {
                    $this->view->response("Error al eliminar el artista", 500);
                }
            } else {
                $this->view->response("Artista ID: $id no existe", 404);
            }
        } else {
            $this->view->response("No se puede eliminar el artista ya que existen canciones que dependen de él. Elimine sus canciones primero", 500);
        }
    }
}