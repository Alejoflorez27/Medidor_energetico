<?php

require_once "conexion.php";

class ModeloCanciones{

	/*================================
	CREAR CANCIONES
    ==================================*/

    static public function mdlIngresarCanciones($tabla, $datos){

		//Aqui se  hace la conexion y se ingresa una categoria a la BD 
    	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nom_cancion, descripcion, ano, id_genero, id_album) VALUES (:nom_cancion, :descripcion, :ano, :id_genero, :id_album)");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":nom_cancion", $datos["nom_cancion"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_INT);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":id_genero", $datos["id_genero"], PDO::PARAM_INT);
		
		//Pasa valores para ejecutar
		$stmt -> bindParam(":id_album", $datos["id_album"], PDO::PARAM_INT);		

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

	/*================================
	MOSTAR CANCIONES
    ==================================*/
    static public function mdlMostrarCanciones($tabla, $item, $valor){

    	if ($item != null) { //Cuando vamos a seleccionar un item en especifico

    		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
    		
    		//Se compara con el valor que traen la BD en ese item
    		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

    		//Ejecuta la sentencia
    		$stmt -> execute();
  
    		//Devolvemos un solo fetch()
    		return $stmt -> fetch();

    		
    	}else{

    		//Para seleccionar todas las categorias de la tabla
    		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
    		
    		//Ejecuta la sentencia
    		$stmt -> execute();

    		//retorna todas las filas
    		return $stmt -> fetchAll();

    	}

    	//Cerramos la conexion a la BD
		$stmt -> close();

		//La ponemos en vacio para la instancia de conexion
		$stmt = null;
    }

	/*================================
	EDITAR CATEGORÍA
    ==================================*/

    static public function mdlEditarCanciones($tabla, $datos){

		//Aqui se  hace la conexion y se ingresa una categoria a la BD 
    	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nom_cancion = :nom_cancion, descripcion = :descripcion, ano = :ano, id_genero = :id_genero, id_album = :id_album WHERE id = :id");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":nom_cancion", $datos["nom_cancion"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_INT);
		
		//Pasa valores para ejecutar
		$stmt -> bindParam(":id_genero", $datos["id_genero"], PDO::PARAM_INT);
		
		//Pasa valores para ejecutar
		$stmt -> bindParam(":id_album", $datos["id_album"], PDO::PARAM_INT);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

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

	/*================================
	BORRAR CATEGORÍA
    ==================================*/

    static public function mdlBorrarCanciones($tabla, $datos){

		//Aqui se  hace la conexion y se borrar una categoria a la BD 
    	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

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

}