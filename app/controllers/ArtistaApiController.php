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

            $campo = (!empty($_GET['campo']) && $this->model->columnExists($_GET['campo']) ? $_GET['campo'] : 'cant_oyentes'); // SI ESTA SETEADO CAMPO Y EXISTE EN LA TABLA DE ARTISTAS, SE ORDENA x ESE CAMPO, SINO POR CANT OYENTES
            $orden = (!empty($_GET['orden']) && $_GET['orden'] == 1) ? "DESC" : "ASC"; //SI ESTA SETEADO EL ORDEN y ES 1 SE ORDENA DESCENDENTEMENTE, SINO ASCENDENTEMENTE

            $pagina = (!empty($_GET['pagina']) ? $_GET['pagina'] : 1);
            $elemPorPagina = (!empty($_GET['cantElemsPagina']) ? $_GET['cantElemsPagina'] : 3);
            $start_index = ($pagina - 1) * $elemPorPagina;

            $artistas = $this->model->getArtistas($campo, $orden, $start_index, $elemPorPagina);
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
            return;
        }

        $body = $this->getData();

        $artista = $this->model->getArtista($id);

        if (!$artista) {
            $this->view->response("El artista ID: $id no existe", 404);
            return;
        }

        $datosNuevos = (array) $body + (array) $artista; //ACA SUMAMOS PARA QUE SE MANTENGAN LOS DATOS EXISTENTES EN CASO DE VENIR VACIO

        foreach ($datosNuevos as $campo) {
            if (empty($campo)) {
                $this->view->response("Faltó ingresar un dato", 400);
            }
        }

        if (!empty($_GET['confirmacion']) && $_GET['confirmacion'] === "true") {

            if (
                $this->model->updateArtista(
                    $datosNuevos['nombre'],
                    $datosNuevos['descripcion'],
                    $datosNuevos['edad'],
                    $datosNuevos['nacionalidad'],
                    $datosNuevos['cant_oyentes'],
                    $id
                )
            ) {
                $this->view->response("Artista actualizado con éxito", 200);
            } else {
                $this->view->response("Error al actualizar el artista", 500);
            }

        } else {
            $confirmarURL = BASE_URL . "api/artistas/$id?confirmacion=true";
            $mensaje = "¿Estás seguro de modificar el artista ID: $id? <a href='$confirmarURL'>Confirmar</a>";
            $this->view->response($mensaje, 200);
        }
    }

    public function delete($params = [])
    {
        $id = $params[':ID'];

        if (empty($id)) {
            $this->view->response("No se ha proporcionado un ID", 400);
            return;
        }

        $artista = $this->model->getArtista($id);

        if ($artista) {

            if (!empty($_GET['confirmacion']) && $_GET['confirmacion'] === "true") {
                if ($this->model->deleteArtista($id)) {
                    $this->view->response("Artista ID: $id eliminado con éxito", 200);
                } else {
                    $this->view->response("Error al eliminar el artista", 500);
                }
            } else {
                $confirmarURL = BASE_URL . "api/artistas/$id?confirmacion=true";
                $mensaje = "¿Estás seguro de eliminar el artista ID: $id? Ten en cuenta que sus canciones quedarán sin artista asociado <a href='$confirmarURL'>Confirmar</a>";
                $this->view->response($mensaje, 200);
            }
        } else {
            $this->view->response("Artista ID: $id no existe", 404);
        }
    }
}