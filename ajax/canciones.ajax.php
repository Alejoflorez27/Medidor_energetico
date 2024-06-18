<?php
//Esto se requiere para que se pueda activar las instancias de segund plano debido a que esto ya habia sido llamado en index.php
require_once "../controladores/canciones.controlador.php";
require_once "../modelos/canciones.modelo.php";


class AjaxCanciones {

	/*==============================
	EDITAR CATEGORIA
	==============================*/

	//Creo variables publicas
	public $idCancion;

	public function ajaxEditarCanciones(){

		//Para que nencuentre una considencia en la tabla
		$item = "id";

		//Le mandamos la propiedad id
		$valor = $this->idCancion;
		
		//Devolvemos la respuesta al controlador
		$respuesta = ControladorCanciones::ctrMostrarCanciones($item, $valor);

		//Para que lo resiava js por esto se le creo en js
		echo json_encode($respuesta);
	}
}

/*==============================
EDITAR CATEGORÍA
==============================*/
//Si existe la variable que trae del metodo post de js
if (isset($_POST["idCancion"])) {

	//Creo un objeto de la clase de AjaxCanciones
	$canciones = new AjaxCanciones();
	//Al objeto $categoria se asigno el idCategoria que guarda la variable post
	$canciones -> idCancion = $_POST["idCancion"];
	//luego ejecuto el metodo ajaxEditarCanciones
	$canciones -> ajaxEditarCanciones();
}