<?php
//Esto se requiere para que se pueda activar las instancias de segund plano debido a que esto ya habia sido llamado en index.php
require_once "../controladores/artistas.controlador.php";
require_once "../modelos/artistas.modelo.php";


class AjaxArtistas {

	/*==============================
	EDITAR ARTISTAS
	==============================*/

	//Creo variables publicas
	public $idArtista;

	public function ajaxEditarArtistas(){

		//Para que nencuentre una considencia en la tabla
		$item = "id";

		//Le mandamos la propiedad id
		$valor = $this->idArtista;
		
		//Devolvemos la respuesta al controlador
		$respuesta = ControladorArtistas::ctrMostrarArtistas($item, $valor);

		//Para que lo resiava js por esto se le creo en js
		echo json_encode($respuesta);
	}
}

/*==============================
EDITAR CATEGORÍA
==============================*/
//Si existe la variable que trae del metodo post de js
if (isset($_POST["idArtista"])) {

	//Creo un objeto de la clase de AjaxArtistas
	$artista = new AjaxArtistas();
	//Al objeto $categoria se asigno el idCategoria que guarda la variable post
	$artista -> idArtista = $_POST["idArtista"];
	//luego ejecuto el metodo ajaxEditarArtistas
	$artista -> ajaxEditarArtistas();
}