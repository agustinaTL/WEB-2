<?php
class VentasModel {
    private $db;

    public function __construct()
    {
        $this->db = new PDO("...");
    }

    public function getVentasByFechaYEvento($fechaCompra, $idEvento){
        $query = $this->db->prepare("SELECT id, cant_entradas FROM Ventas WHERE fecha_compra = ? AND id_evento = ?");
        $query->execute([$fechaCompra, $idEvento]);
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}