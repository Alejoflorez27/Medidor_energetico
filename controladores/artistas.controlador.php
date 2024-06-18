<?php

class ControladorArtistas{

	/*=====================================
	CREAR ARTISTAS
	=====================================*/

	static public function ctrCrearArtistas(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["nuevoArtista"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoArtista"])) {

				$tabla = "artistas";

				$datos = array("nombre_art"=>$_POST["nuevoArtista"], "edad"=>$_POST["nuevaEdad"], "biografia"=>$_POST["nuevaBiografia"]);

				$respuesta = ModeloArtistas::mdlIngresarArtista($tabla, $datos);

				if ($respuesta == "ok") {

					/*Alertas suaves para decir que la artista a sido guardada
					los campos del formulario de crear un artista) el plugin se encuentra en plantilla.php*/
					echo '<script>

						swal({

							type: "success",
							title: "El Artista ha sido guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{

							if(result.value){
							
								window.location = "artistas";

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
						title: "¡El Artista no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
	

					}).then((result)=>{

						if(result.value){
						
							window.location = "artistas";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	MOSTRAR CATEGORIAS
	=====================================*/
	static public function ctrMostrarArtistas($item, $valor){

		//Para mandarle los parametros al modelo de categorias
		$tabla = "artistas";

		//Se los pasamos al modelo para que nos retorne una respuesta
		$respuesta = ModeloArtistas::mdlMostrarArtistas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=====================================
	EDITAR ARTISTAS
	=====================================*/

	static public function ctrEditarArtista(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["editarArtista"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarArtista"])) {

				$tabla = "artistas";

				$datos = array("nombre_art"=>$_POST["editarArtista"],
				               "edad"=>$_POST["editarEdad"],
							   "biografia"=>$_POST["editarBiografia"],
				               "id"=>$_POST["idArtista"]);
                
				$respuesta = ModeloArtistas::mdlEditarArtista($tabla, $datos);

				if ($respuesta == "ok") {

					/*Alertas suaves para decir que la categoria a sido guardada
					los campos del formulario de crear un categoria) el plugin se encuentra en plantilla.php*/
					echo '<script>

						swal({

							type: "success",
							title: "El artista ha sido cambiada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{

							if(result.value){
							
								window.location = "artistas";

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
						title: "¡El Artista no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
	

					}).then((result)=>{

						if(result.value){
						
							window.location = "artistas";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	BORRAR CATEGORIAS
	=====================================*/

	static public function ctrBorrarArtista(){

		if (isset($_GET["idArtista"])) {
			
			$tabla = "artistas";
			$datos = $_GET["idArtista"];

			$respuesta = ModeloArtistas::mdlBorrarArtista($tabla, $datos);

			if ($respuesta == "ok") {
				
				/*Alertas suaves para decir que la artista a sido guardada
				los campos del formulario de crear un artista) el plugin se encuentra en plantilla.php*/
				echo '<script>

					swal({

						type: "success",
						title: "El Artista ha sido borrada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					 }).then((result)=>{

						if(result.value){
							
							window.location = "artistas";

						}

					});
					

				</script>';

			}
		}
	}
}
	




