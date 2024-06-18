<?php

class ControladorAlbunes{

	/*=====================================
	CREAR CATEGORIAS
	=====================================*/

	static public function ctrCrearAlbunes(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["IdDimension"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["IdDimension"])) {

				$tabla = "indicador_prueba";

				$datos = array("IdDimension"=>$_POST["IdDimension"], "Fecha"=>$_POST["Fecha"], "Numerador"=>$_POST["Numerador"], "Denominador"=>$_POST["Denominador"], "DescripcionIndicador"=>$_POST["DescripcionIndicador"], "Valor"=>$_POST["Valor"]);

				var_dump($datos);
				$respuesta = ModeloAlbunes::mdlIngresarAlbunes($tabla, $datos);
				var_dump($respuesta);
				if ($respuesta == "ok") {

					/*Alertas suaves para decir que la categoria a sido guardada
					los campos del formulario de crear un categoria) el plugin se encuentra en plantilla.php*/
					echo '<script>

						swal({

							type: "success",
							title: "El Albúm ha sido guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{

							if(result.value){
							
								window.location = "albunes";

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
						title: "¡El Albúm no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
	

					}).then((result)=>{

						if(result.value){
						
							window.location = "albunes";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	MOSTRAR CATEGORIAS
	=====================================
	static public function ctrMostrarAlbunes($item, $valor){

		//Para mandarle los parametros al modelo de categorias
		$tabla = "albumes";

		//Se los pasamos al modelo para que nos retorne una respuesta
		$respuesta = ModeloAlbunes::mdlMostrarAlbunes($tabla, $item, $valor);

		return $respuesta;

	}*/

	/*=====================================
	MOSTRAR CATEGORIAS
	=====================================*/
	static public function ctrMostrarAlbunes($item, $valor){

		//Para mandarle los parametros al modelo de categorias
		$tabla = "indicador_prueba";

		//Se los pasamos al modelo para que nos retorne una respuesta
		$respuesta = ModeloAlbunes::mdlMostrarAlbunes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=====================================
	EDITAR CATEGORIAS
	=====================================*/

	static public function ctrEditarAlbunes(){

		//un filtro para saber si se esta enviando información del formulario
		if (isset($_POST["editarAlbum"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarAlbum"])) {

				$tabla = "albumes";

				$datos = array("nom_album"=>$_POST["editarAlbum"],
				               "descripcion"=>$_POST["editarDescripcion"],
							   "ano"=>$_POST["editarAno"],
				               "id"=>$_POST["idAlbum"]);

				$respuesta = ModeloAlbunes::mdlEditarAlbunes($tabla, $datos);

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
							
								window.location = "albunes";

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
						
							window.location = "albunes";

						}

					});
				

				</script>';				

			}

		}
		
	}

	/*=====================================
	BORRAR CATEGORIAS
	=====================================*/

	static public function ctrBorrarAlbunes(){

		if (isset($_GET["idAlbum"])) {
			
			$tabla = "albumes";
			$datos = $_GET["idAlbum"];

			$respuesta = ModeloAlbunes::mdlBorrarAlbunes($tabla, $datos);

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
							
							window.location = "albunes";

						}

					});
					

				</script>';

			}
		}
	}
}
	




