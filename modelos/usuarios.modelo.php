<?php

//incluye y evalua el fichero especificado
require_once "conexion.php";

class ModeloUsuarios{

	/*===========================
	MOSTRAR USUARIOS
	===========================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if ($item != null) {
			
			//Aqui se  hace la conexion y guardando solo una parte que es la de tabla de usuarios que es usuario y lo guarda es $stmt
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			//Esta a la espera de un dato tipo String
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			//ejecuta una consulta que había sido previamente preparada usando la función mysql
			$stmt -> execute();

			//Devuelve una sola linea
			return $stmt -> fetch();

		}else{

			//Aqui se  hace la conexion y guardando que es la de tabla de usuarios y lo guarda es $stmt
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			//ejecuta una consulta que había sido previamente preparada usando la función mysql
			$stmt -> execute();

			//Devolveria todas las filas
			return $stmt -> fetchAll();



		}

		

		//Cerramos la conexion a la BD
		$stmt -> close();

		//La ponemos en vacio para la instancia de conexion
		$stmt = null;		
	}

	/*===========================
	INGRESAR USUARIOS
	===========================*/
	//le entran los parametros que vienen almacenados desde el controlador de usuarios (tabla, array)
	static public function mdlIngresarUsuarios($tabla, $datos){

		//Aqui se  hace la conexion y se ingresa un usuario a la BD 
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if ($stmt ->execute()) {
			
			return "ok";

		}else{

			return "error";

		}

		//Cerramos la conexion a la BD
		$stmt -> close();

		//La ponemos en vacio para la instancia de conexion
		$stmt = null;
	}

	/*===========================
	EDITAR USUARIO
	===========================*/

	static public function mdlEditarUsuario($tabla, $datos){

		//Aqui se  hace la conexion y se edita un usuario que esta en la BD
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");
		
		//Pasa valores para ejecutar
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt ->execute()) {
			
			return "ok";

		}else{

			return "error";

		}

		//Cerramos la conexion a la BD
		$stmt -> close();

		//La ponemos en vacio para la instancia de conexion
		$stmt = null;

	}

	/*===========================
	ACTUALIZAR USUARIO
	===========================*/
	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		//Esto se usa para una actualizacion dinamica cuando se requiera de un campo de la BD
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		//Aqui esta el estado y en que valor esta esto para item1
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		//Aqui esta el id y en que valor esta esto para item2
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if ($stmt ->execute()) {
			
			return "ok";

		}else{

			return "error";

		}

		//Cerramos la conexion a la BD
		$stmt -> close();

		//La ponemos en vacio para la instancia de conexion
		$stmt = null;

	}

	/*===========================
	BORRAR USUARIO
	===========================*/
	static public function mdlBorrarUsuario($tabla, $datos){

		//Esto se usa para borrar cuando se requiera de la BD
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		//Aqui esta el id de la base de datos
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			return "error";

		}

		//Cerramos la conexion a la BD
		$stmt -> close();

		//La ponemos en vacio para la instancia de conexion
		$stmt = null; 


	}

}