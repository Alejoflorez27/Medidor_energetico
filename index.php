<?php


require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/canciones.controlador.php";
require_once "controladores/albunes.controlador.php";
require_once "controladores/artistas.controlador.php";
require_once "controladores/monitor.controlador.php";

require_once "modelos/plantilla.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/canciones.modelo.php";
require_once "modelos/albunes.modelo.php";
require_once "modelos/artistas.modelo.php";
require_once "modelos/monitor.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();




