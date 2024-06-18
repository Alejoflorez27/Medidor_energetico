<?php

class ControladorUsuarios{

	/*================================
	INGRESO DE USUARIO
	==================================*/

	static public function ctrIngresoUsuario()
	{
		
		//Revisa que traiga los datos de esa variable $_POST
		if (isset($_POST["ingUsuario"])) {
			 
			//Le permite ciertos caracteres a lo que esta en las variables $_POST
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   	preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				//variable para guardar el password y este mismo encryptarlo
				$encriptar = crypt($_POST["ingPassword"], '2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			   	$tabla = "usuarios";

			   	$item = "usuario";

			   	$valor = $_POST["ingUsuario"];

			   	//Guarda en especifico los datos de un metodo que esta en una clase (Modelos que es donde se encuentra el SQL)
			   	$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

			   	//Si los datos corresponden a la insercion de los mismos y ademas se le pasa el de la BD encriptado
			   	if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

			   		//Si valor de estado que se encuentra en la BD es igual a 1 le da acceso
			   		if ($respuesta["estado"] == 1) {

			   		//Variables de seccion para la cual nos da el ingreso a la pagina web y acomodar en lo otro de la pagina
			   		$_SESSION["iniciarSesion"] = "ok";
			   		$_SESSION["id"] = $respuesta["id"];
			   		$_SESSION["nombre"] = $respuesta["nombre"];
			   		$_SESSION["usuario"] = $respuesta["usuario"];
			   		$_SESSION["foto"] = $respuesta["foto"];
			   		$_SESSION["perfil"] = $respuesta["perfil"];
			   		
			   		/*==========================================
					REGISTRAR FECHA PARA SABER ULTIMO LOGIN
					==========================================*/
					//Se le estableze la zona horaria en la que nos encontramos
					date_default_timezone_set('America/Bogota');

					//Se le definen los formatos como se encuentran en la base de datos de la fecha y hora
					$fecha = date('Y-m-d');
					$hora = date('H:i:s');

					//En esta variable se concatenan lo dos formatos para hacer un buen registro con el formato adecuado
					$fechaActual = $fecha.' '.$hora;

					//esto se hace para gardar ese registro en la BD tanto el ultimo login como el id de dicha persona
					$item1 = "ultimo_login";
					$valor1 = $fechaActual;

					$item2 = "id";
					$valor2 = $respuesta["id"];

					//Le manda esto a la clase por el metodo de modelo de actulizar para realizarlo en la BD
					$ultimologin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

					if ($ultimologin == "ok") {
				   		echo '<script>

			   				window.location = "inicio";

			   			</script>';
					}



			   		}else{

			   			echo '<br><div class="alert alert-danger">El usuario aún no está activado</div>';

			   		}
			   		


			   	}else{

			   		echo '<br><div class="alert alert-danger">Error a ingresar, vuelve a intentarlo</div>';
			   	}			
			}

		}

	}

	/*================================
	REGISTRO DE USUARIO
	==================================*/

	static public function ctrCrearUsuario(){

		//un filtro para saber si se esta enviando información
		if (isset($_POST["nuevoUsuario"])) {
			
			//le vamos a permitir las tildes y unos caracteres para cada variable $POST
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			    preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"])  &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) {

				/*================================
				VALIDAR IMAGEN
				==================================*/
				$ruta = "";

				if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

					/*Creamos una lista de php para crear una nuevo array y le asigno los
					indeces para el tamaño de la imagen*/
					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					//Para vizualizar que nos trae el metodo getimagesize que allí trae el tamaño de la imagen
					//var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));

					//Para visualizar si cargo a la hora de madar el formulario con la imagen
					//var_dump($_FILES["nuevaFoto"]["tmp_name"]);

					//Para la redimencion de la imagen
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*================================
				    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				    ==================================*/
				    //le concatenamos el nuevoUsuario y ese va a ser el nombre de la carpeta
				    $directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

				    //utilizamos el metodo de js para crear el directorio con los parametros(NombreCarpeta, permisos)
				    mkdir($directorio, 0755);

					/*================================
				    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				    ==================================*/

				    if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
						
						/*================================
					    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					    ==================================*/

					    //Guardamos en aleatorio el rango para los archivos
					    $aleatorio = mt_rand(100,900);

					    //Donde esta la direccion donde se guarada y nombre de usuario aleatorio y jpg
					    $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

					    //Se le indica que es especifica de jpeg
					    $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

					    //El metodo permite que no cambie el color de la imgen con el nuvo tamaño
					    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						//Me permite ajustar la imagen de 500*500
						//parametros(recorte_img_nueva, origen_imagen destino,corte en x destino, corte en y destino, donde se hace el corte x, donde se hace el corte y, nuevo ancho, nuevo alto, ancho, alto )   
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						//metodo en el cual ya esta el destino y ruta
						imagejpeg($destino, $ruta);


				    }

				    if ($_FILES["nuevaFoto"]["type"] == "image/png") {
						
						/*================================
					    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					    ==================================*/

					    //Guardamos en aleatorio el rango para los archivos
					    $aleatorio = mt_rand(100,900);

					    //Donde esta la direccion donde se guarada y nombre de usuario aleatorio y jpg
					    $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

					    //Se le indica que es especifica de jpeg
					    $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

					    //El metodo permite que no cambie el color de la imgen con el nuvo tamaño
					    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						//Me permite ajustar la imagen de 500*500
						//parametros(recorte_img_nueva, origen_imagen destino,corte en x destino, corte en y destino, donde se hace el corte x, donde se hace el corte y, nuevo ancho, nuevo alto, ancho, alto )   
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						//metodo en el cual ya esta el destino y ruta
						imagepng($destino, $ruta);


				    }


				}

				//Le especifico la tabla que se encuentra en la BD
				$tabla = "usuarios";

				//variable de php para proteger la contraseña del usuario por medio del hash de tipo blowfish
				//para desencriptar tendriamos que usar el mismo hash
				$encriptar = crypt($_POST["nuevoPassword"], '2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				//Guarda los datos de la tabla usuarios en un array para trabajar en otras paginas
				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "usuario" => $_POST["nuevoUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["nuevoPerfil"],
							   "foto" => $ruta);

				//Desde aqui se le mandan los argumentos al metodo MdlIngresarUsuario que esta en usuarios.modulo.php
				$respuesta = ModeloUsuarios::MdlIngresarUsuarios($tabla, $datos);

				if ($respuesta == "ok") {
					
				/*Alertas suaves por si algun caracter malo o no son los especificados
				 (sweetalert2 es un plugin para los errores de insercion de datos en 
				 los campos del formulario de crear un usuario) el plugin se encuentra en plantilla.php*/
				echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

				}				



			}else{

				/*Alertas suaves por si algun caracter malo o no son los especificados
				 (sweetalert2 es un plugin para los errores de insercion de datos en 
				 los campos del formulario de crear un usuario) el plugin se encuentra en plantilla.php*/
				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

			}

		}
	}

	/*================================
	MOSTRAR USUARIO
	==================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;


	}

	/*================================
	EDITAR USUARIO
	==================================*/

	static public function ctrEditarUsuario(){

		if (isset($_POST["editarUsuario"])) {

			//le vamos a permitir las tildes y unos caracteres para cada variable $POST
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

				/*================================
				VALIDAR IMAGEN
				==================================*/
				$ruta = $_POST["fotoActual"];

				// Si existe y ademas si es diferente de vacio que ponga la foto viene de files de la vista de usuarios.php
				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					/*Creamos una lista de php para crear una nuevo array y le asigno los
					indeces para el tamaño de la imagen*/
					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					//Para vizualizar que nos trae el metodo getimagesize que allí trae el tamaño de la imagen
					//var_dump(getimagesize($_FILES["editarFoto"]["tmp_name"]));

					//Para visualizar si cargo a la hora de madar el formulario con la imagen
					//var_dump($_FILES["editarFoto"]["tmp_name"]);

					//Para la redimencion de la imagen
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*================================
				    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				    ==================================*/
				    //le concatenamos el nuevoUsuario y ese va a ser el nombre de la carpeta
				    $directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*================================
				    PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				    ==================================*/

				    if (!empty($_POST["fotoActual"])) {
				    	
				    	//Para que nos borre un archivo en la base de datos y cambie por la que ya existe en la BD 
				    	unlink($_POST["fotoActual"]);

				    }else{
					    //utilizamos el metodo de js para crear el directorio con los parametros(NombreCarpeta, permisos)
					    mkdir($directorio, 0755);
				    }

					/*================================
				    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				    ==================================*/

				    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
						
						/*================================
					    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					    ==================================*/

					    //Guardamos en aleatorio el rango para los archivos
					    $aleatorio = mt_rand(100,900);

					    //Donde esta la direccion donde se guarada y nombre de usuario aleatorio y jpg
					    $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

					    //Se le indica que es especifica de jpeg
					    $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

					    //El metodo permite que no cambie el color de la imgen con el nuvo tamaño
					    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						//Me permite ajustar la imagen de 500*500
						//parametros(recorte_img_nueva, origen_imagen destino,corte en x destino, corte en y destino, donde se hace el corte x, donde se hace el corte y, nuevo ancho, nuevo alto, ancho, alto )   
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						//metodo en el cual ya esta el destino y ruta
						imagejpeg($destino, $ruta);


				    }

				    if ($_FILES["editarFoto"]["type"] == "image/png") {
						
						/*================================
					    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					    ==================================*/

					    //Guardamos en aleatorio el rango para los archivos
					    $aleatorio = mt_rand(100,900);

					    //Donde esta la direccion donde se guarada y nombre de usuario aleatorio y jpg
					    $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

					    //Se le indica que es especifica de jpeg
					    $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

					    //El metodo permite que no cambie el color de la imgen con el nuvo tamaño
					    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						//Me permite ajustar la imagen de 500*500
						//parametros(recorte_img_nueva, origen_imagen destino,corte en x destino, corte en y destino, donde se hace el corte x, donde se hace el corte y, nuevo ancho, nuevo alto, ancho, alto )   
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						//metodo en el cual ya esta el destino y ruta
						imagepng($destino, $ruta);


				    }


				}

				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
						//variable de php para proteger la contraseña del usuario por medio del hash de tipo blowfish
					    //para desencriptar tendriamos que usar el mismo hash
					    $encriptar = crypt($_POST["editarPassword"], '2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');			
					}else{

						/*Alertas suaves por si algun caracter malo o no son los especificados
						(sweetalert2 es un plugin para los errores de insercion de datos en 
						los campos del formulario de crear un usuario) el plugin se encuentra en plantilla.php*/
						echo '<script>

								swal({

									type: "error",
									title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
									}).then((result)=>{

										if(result.value){
									
										window.location = "usuarios";

									}

								})
						

						</script>';					

					}
				}else{

					$encriptar = $passwordActual;

				}

				//Guarda los datos de la tabla usuarios en un array para trabajar en otras paginas
				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				//Desde aqui se le mandan los argumentos al metodo MdlEditarUsuario que esta en usuarios.modelo.php
				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					
					/*Alertas suaves por si algun caracter malo o no son los especificados
					 (sweetalert2 es un plugin para los errores de insercion de datos en 
					 los campos del formulario de crear un usuario) el plugin se encuentra en plantilla.php*/
					echo '<script>

						swal({

							type: "success",
							title: "¡El usuario ha sido editado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result)=>{

								if(result.value){
							
								window.location = "usuarios";

							}

						})
					

					</script>';

				}

			}
			else{

				/*Alertas suaves por si algun caracter malo o no son los especificados
				 (sweetalert2 es un plugin para los errores de insercion de datos en 
				 los campos del formulario de crear un usuario) el plugin se encuentra en plantilla.php*/
				echo '<script>

					swal({

						type: "error",
						title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{
							
							if(result.value){
						
							window.location = "usuarios";

						}

					})
				

				</script>';

			}			
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/
	//El metodo se dispara apenas el id exita que viene de la vista
	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){		//Si la variable $_GET["idUsuario"] existe

			$tabla ="usuarios";				//Se asignan las variable con la tabla que es usuarios
			$datos = $_GET["idUsuario"];	//Se asigna el id del usuario en datos 

			if($_GET["fotoUsuario"] != ""){		//Si la variable $_GET["fotoUsuario"] es diferente de vacio 

				unlink($_GET["fotoUsuario"]);	//Encuentra la foto de es usuario 
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);		//Borra el directorio en el que usuario esta llamado

			}

			//Se le manda los argumentos al modelo para que me retorne y me lo guarde en una respuesta
			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			//Si la respuesta es verdadera el sistema me muestra una venta en la cual la accion ya a terminado
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}
	
}



