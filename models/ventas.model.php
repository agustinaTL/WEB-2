<?php
class VentasModel{
    private $db;
    
    public function __construct(){
        $this->db = new PDO("...");
    }

    public function agregarVenta($idVentas, $idEvento, $idUsuario, $cantEntradas, $fechaCompra){
        $query = $this->db->prepare("INSERT INTO Ventas 
        (id_evento, id_usuario, cant_entradas, fecha_compra) VALUES (?, ?, ?, ?)");
        $query->execute([$idVentas, $idEvento, $idUsuario, $cantEntradas, $fechaCompra]);
        $id = $this->db->lastInsertId();
        return $id;
    }
}
