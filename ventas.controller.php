<?php
require_once 'models/ventas.model.php';
require_once 'models/evento.model.php';
require_once 'view/ventas.view.php';

class VentasController {
    private $ventasModel;
    private $eventoModel;
    private $view;

    public function __construct()
    {
        $this->ventasModel = new VentasModel();
        $this->eventoModel = new EventoModel();
        $this->view = new VentasView();
    }

    public function getVentas(){
        //valido entrada de datos
        if(empty($_GET['fecha_compra']) || empty($_GET['id_evento'])){
            $this->view->showError("Falta ingresar datos obligatorios");
            return;
        }

        //obtengo los datos por GET
        $fechaCompra = $_GET['fecha_compra'];
        $idEvento = $_GET['id_evento'];

        //verifico que el evento exista
        $evento = $this->eventoModel->getById($idEvento);

        if(empty($evento)){
            $this->view->showError("El evento no existe");
            return;
        }

        //obtengo todas las ventas para la fecha y evento solicitado, y calculo el total de cada una
        $ventas = $this->ventasModel->getVentasByFechaYEvento($fechaCompra, $idEvento);

        foreach($ventas as $venta){
            $venta->total = $venta->cant_entradas * $evento->precio;
        }

        $this->view->showVentas($ventas);
    }
}