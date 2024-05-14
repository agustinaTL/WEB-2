<?php

require_once 'models/eventos.model.php';
require_once 'models/usuarios.model.php';
require_once 'models/ventas.model.php';
require_once 'view/ventas.view.php';

class VentasController{
    private $ventasModel;
    private $eventosModel;
    private $usuariosModel;
    private $view;

    public function __construct(){
        $this->ventasModel = new VentasModel();
        $this->eventosModel = new EventosModel();
        $this->usuariosModel = new UsuariosModel();
        $this->view = new ViewVentas();
    }

    public function addVenta(){
        //Controlo posibles errores de carga
        if(empty($_POST['id']) || empty($_POST['id_evento']) || empty($_POST['id_usuario'])
        || empty($_POST['cant_entradas']) || empty($_POST['fecha_compra'])){
        
            $this->view->showError("Complete todos los campos");
            return;
        }

        //Guardo los datos ingresados en variables
        $idVentas = $_POST['id'];
        $idEvento = $_POST['id_evento'];
        $idUsuario = $_POST['id_usuario'];
        $cantEntradas = $_POST['cant_entradas'];
        $fechaCompra = $_POST['fecha_compra'];

        // Verifico que el evento y el usuario existen
        $evento = $this->eventosModel->getEventoById($idEvento);

        if(!$evento){
            $this->view->showError("El evento no existe");
            return;
        }

        $usuario = $this->usuariosModel->getUsuarioById($idUsuario);

        if(!$usuario){
            $this->view->showError("El usuario no existe");
            return;
        }

        //Controlo que haya suficientes entradas disponibles para realizar la venta
        
        if($cantEntradas > $evento->entradas_restantes){
            $this->view->showError("No hay entradas suficientes para realizar la venta");
            return;
        }

        // Agrego la venta
        $venta = $this->ventasModel->agregarVenta($idVentas, $idEvento, $idUsuario, $cantEntradas, $fechaCompra);

        if(!$venta){
            $this->view->showError("No se pudo almacenar la Venta en la DB");
        }

        // Actualizo la cantidad de entradas restantes
        $restadas = $this->eventosModel->restarEntradas($idEvento, $cantEntradas);

        $this->view->showVenta($venta);

    }
}
?>