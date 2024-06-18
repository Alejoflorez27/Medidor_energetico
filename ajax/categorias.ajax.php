<?php
//Esto se requiere para que se pueda activar las instancias de segund plano debido a que esto ya habia sido llamado en index.php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class AjaxCategorias {

	/*==============================
	EDITAR CATEGORIA
	==============================*/

	//Creo variables publicas
	public $idCategoria;

	public function ajaxEditarCategorias(){

		//Para que nencuentre una considencia en la tabla
		$item = "id";

		//Le mandamos la propiedad id
		$valor = $this->idCategoria;
		
		//Devolvemos la respuesta al controlador
		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		//Para que lo resiava js por esto se le creo en js
		echo json_encode($respuesta);
	}
}

/*==============================
EDITAR CATEGORÍA
==============================*/
//Si existe la variable que trae del metodo post de js
if (isset($_POST["idCategoria"])) {

	//Creo un objeto de la clase de AjaxCategorias
	$categoria = new AjaxCategorias();
	//Al objeto $categoria se asigno el idCategoria que guarda la variable post
	$categoria -> idCategoria = $_POST["idCategoria"];
	//luego ejecuto el metodo AjaxEditarCategorias
	$categoria -> ajaxEditarCategorias();
}