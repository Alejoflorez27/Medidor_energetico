<?php

class ControladorCanciones{

	/*=====================================
	CREAR CANCIONES
	=====================================*/

	static public function ctrCrearCanciones(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["nuevaCancion"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCancion"])) {

				$tabla = "canciones";

				$datos = array("nom_cancion"=>$_POST["nuevaCancion"], 
							   "descripcion"=>$_POST["nuevaDescripcion"], 
							   "ano"=>$_POST["nuevaAno"], 
							   "id_genero"=>$_POST["nuevoGenero"], 
							   "id_album"=>$_POST["nuevoAlbun"]);

				$respuesta = ModeloCanciones::mdlIngresarCanciones($tabla, $datos);

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
							
								window.location = "canciones";

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
						
							window.location = "canciones";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	MOSTRAR CANCIONES
	=====================================*/
	static public function ctrMostrarCanciones($item, $valor){

		//Para mandarle los parametros al modelo de categorias
		$tabla = "canciones";

		//Se los pasamos al modelo para que nos retorne una respuesta
		$respuesta = ModeloCanciones::mdlMostrarCanciones($tabla, $item, $valor);

		return $respuesta;

	}

	/*=====================================
	EDITAR CATEGORIAS
	=====================================*/

	static public function ctrEditarCanciones(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["editarCancion"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCancion"])) {

				$tabla = "canciones";

				$datos = array("nom_cancion"=>$_POST["editarCancion"],
				               "descripcion"=>$_POST["editarDescripcion"],
							   "ano"=>$_POST["editarAno"],
				               "id_genero"=>$_POST["editarGenero"],
							   "id_album"=>$_POST["editarAlbun"],
				               "id"=>$_POST["idCancion"]);
				print_r($datos);
				$respuesta = ModeloCanciones::mdlEditarCanciones($tabla, $datos);

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
							
								window.location = "canciones";

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
						
							window.location = "canciones";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	BORRAR CATEGORIAS
	=====================================*/

	static public function ctrBorrarCanciones(){

		if (isset($_GET["idCancion"])) {
			
			$tabla = "canciones";
			$datos = $_GET["idCancion"];

			$respuesta = ModeloCanciones::mdlBorrarCanciones($tabla, $datos);

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
							
							window.location = "canciones";

						}

					});
					

				</script>';

			}
		}
	}
}
	




