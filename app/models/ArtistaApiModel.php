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

    public function getArtistas(){
        $query = $this->db->prepare("SELECT * FROM artistas");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getArtista($id){
        $query = $this->db->prepare('SELECT * from artistas WHERE id = ?');
        $query->execute([$id]);
        $artista = $query->fetch(PDO::FETCH_OBJ);

        return $artista;
    }
}