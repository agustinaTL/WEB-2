<?php
class EventosModel{
    private $db;

    public function __construct(){
        $this->db = new PDO("...");
    }

    public function getEventoById($idEvento){
        $query = $this->db->prepare("SELECT * FROM Eventos WHERE id = ?");
        $query->execute([$idEvento]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function restarEntradas($cantEntradas, $idEvento){
        $query = $this->db->prepare("UPDATE Eventos SET entradas_restantes = entradas_restantes - ? WHERE id = ?");
        return $query->execute([$cantEntradas, $idEvento]);
    }
}