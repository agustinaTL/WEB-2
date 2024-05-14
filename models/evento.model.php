<?php
class EventoModel {
    private $db;

    public function __construct(){
        $this->db = new PDO("...");
    }

    public function getById($id){
        $query = $this->db->prepare("SELECT precio FROM Eventos WHERE id = ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}