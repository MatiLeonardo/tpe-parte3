<?php
require_once 'config.php';

class ArtistaApiModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . DB_HOST .
            ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
    }

    public function getArtistas()
    {
        $query = $this->db->prepare("SELECT * FROM artistas ORDER BY cant_oyentes DESC");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getArtistasOrdenado($orden)
    {
        $query = $this->db->prepare("SELECT * FROM artistas ORDER BY ? DESC");
        $query->execute([$orden]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getArtista($id)
    {
        $query = $this->db->prepare('SELECT * from artistas WHERE id = ?');
        $query->execute([$id]);
        $artista = $query->fetch(PDO::FETCH_OBJ);

        return $artista;
    }

    public function getArtistaName($nombre)
    {
        $query = $this->db->prepare('SELECT * from artistas WHERE nombre = ?');
        $query->execute([$nombre]);
        $artista = $query->fetch(PDO::FETCH_OBJ);

        return $artista;
    }

    function addArtista($nombre, $descripcion, $edad, $nacionalidad, $oyentes)
    {
        $query = $this->db->prepare('INSERT INTO artistas (nombre, descripcion, edad, nacionalidad, cant_oyentes) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $descripcion, $edad, $nacionalidad, $oyentes]);

        return $this->db->lastInsertId();

    }

    public function updateArtista($nombre, $descripcion, $edad, $nacionalidad, $cant_oyentes,  $id){
        $query = $this->db->prepare('UPDATE `artistas` SET `nombre` = ?, `descripcion` = ?, `edad` = ?, `nacionalidad` = ?, `cant_oyentes` = ? WHERE id = ?');
        $query->execute([$nombre, $descripcion, $edad, $nacionalidad, $cant_oyentes, $id]);

        return $query->rowCount() > 0;

    }



    public function deleteArtista($id)
    {
        $query = $this->db->prepare('DELETE FROM artistas WHERE id = ?');
        $query->execute([$id]);

        return $query->rowCount() > 0;
    }

    public function getCancionesArtista($id){
        $query = $this->db->prepare("SELECT * from canciones WHERE id_artista = ?");
        $query->execute([$id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}