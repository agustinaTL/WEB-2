<?php
class UsuariosModel{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("...");
    }

    public function getUsuarioById($idUsuario){
        $query = $this->db->prepare("SELECT * FROM Usuarios WHERE id = ?");
        $query->execute([$idUsuario]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}