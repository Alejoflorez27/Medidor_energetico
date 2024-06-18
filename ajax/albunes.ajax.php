<?php
//Esto se requiere para que se pueda activar las instancias de segundo plano debido a que esto ya habia sido llamado en index.php
require_once "../controladores/albunes.controlador.php";
require_once "../modelos/albunes.modelo.php";


class AjaxAlbunes {

	/*==============================
	EDITAR ALBUM
	==============================*/

	//Creo variables publicas
	public $idAlbum;

	public function ajaxEditarAlbunes(){

		//Para que nencuentre una considencia en la tabla
		$item = "id";

		//Le mandamos la propiedad id
		$valor = $this->idAlbum;
		
		//Devolvemos la respuesta al controlador
		$respuesta = ControladorAlbunes::ctrMostrarAlbunes($item, $valor);

		//Para que lo resiava js por esto se le creo en js
		echo json_encode($respuesta);
	}
}

/*==============================
EDITAR ALBUM
==============================*/
//Si existe la variable que trae del metodo post de js
if (isset($_POST["idAlbum"])) {

	//Creo un objeto de la clase de AjaxAlbunes
	$album = new AjaxAlbunes();
	//Al objeto $categoria se asigno el idAlbum que guarda la variable post
	$album -> idAlbum = $_POST["idAlbum"];
	//luego ejecuto el metodo ajaxEditarAlbunes
	$album -> ajaxEditarAlbunes();
}