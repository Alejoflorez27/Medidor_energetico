<?php

class ControladorCategorias{

	/*=====================================
	CREAR CATEGORIAS
	=====================================*/

	static public function ctrCrearCategoria(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["nuevaCategoria"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {

				$tabla = "generos";

				$datos = array("nom_genero"=>$_POST["nuevaCategoria"], "descripcion"=>$_POST["nuevaDescripcion"], "ano"=>$_POST["nuevaAno"]);

				$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

				if ($respuesta == "ok") {

					/*Alertas suaves para decir que la categoria a sido guardada
					los campos del formulario de crear un categoria) el plugin se encuentra en plantilla.php*/
					echo '<script>

						swal({

							type: "success",
							title: "El Genero ha sido guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{

							if(result.value){
							
								window.location = "categorias";

							}

						});
					

					</script>';
					
				}
				
			}else{

				/*Alertas suaves por si algun caracter malo o no son los especificados
				(sweetalert2 es un plugin para los errores de insercion de datos en 
				los campos del formulario de crear categorias) el plugin se encuentra en plantilla.php*/
				echo '<script>

					swal({

						type: "error",
						title: "¡El Genero no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
	

					}).then((result)=>{

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	MOSTRAR CATEGORIAS
	=====================================*/
	static public function ctrMostrarCategorias($item, $valor){

		//Para mandarle los parametros al modelo de categorias
		$tabla = "generos";

		//Se los pasamos al modelo para que nos retorne una respuesta
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;

	}

	/*=====================================
	EDITAR CATEGORIAS
	=====================================*/

	static public function ctrEditarCategoria(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["editarCategoria"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {

				$tabla = "generos";

				$datos = array("categoria"=>$_POST["editarCategoria"],
				               "descripcion"=>$_POST["editarDescripcion"],
							   "ano"=>$_POST["editarAno"],
				               "id"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if ($respuesta == "ok") {

					/*Alertas suaves para decir que la categoria a sido guardada
					los campos del formulario de crear un categoria) el plugin se encuentra en plantilla.php*/
					echo '<script>

						swal({

							type: "success",
							title: "El Genero ha sido cambiada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{

							if(result.value){
							
								window.location = "categorias";

							}

						});
					

					</script>';
					
				}
				
			}else{

				/*Alertas suaves por si algun caracter malo o no son los especificados
				(sweetalert2 es un plugin para los errores de insercion de datos en 
				los campos del formulario de crear categorias) el plugin se encuentra en plantilla.php*/
				echo '<script>

					swal({

						type: "error",
						title: "¡El Genero no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
	

					}).then((result)=>{

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	BORRAR CATEGORIAS
	=====================================*/

	static public function ctrBorrarCategoria(){

		if (isset($_GET["idCategoria"])) {
			
			$tabla = "generos";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if ($respuesta == "ok") {
				
				/*Alertas suaves para decir que la categoria a sido guardada
				los campos del formulario de crear un categoria) el plugin se encuentra en plantilla.php*/
				echo '<script>

					swal({

						type: "success",
						title: "El Genero ha sido borrada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					 }).then((result)=>{

						if(result.value){
							
							window.location = "categorias";

						}

					});
					

				</script>';

			}
		}
	}
}
	




