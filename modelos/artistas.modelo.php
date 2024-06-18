<?php

require_once "conexion.php";

class ModeloArtistas{

	/*================================
	CREAR ARTISTA
    ==================================*/

    static public function mdlIngresarArtista($tabla, $datos){

		//Aqui se  hace la conexion y se ingresa una artista a la BD 
    	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_art, edad, biografia) VALUES (:nombre_art, :edad, :biografia)");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":nombre_art", $datos["nombre_art"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":edad", $datos["edad"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":biografia", $datos["biografia"], PDO::PARAM_STR);

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
	MOSTAR ARTISTAS
    ==================================*/
    static public function mdlMostrarArtistas($tabla, $item, $valor){

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

    static public function mdlEditarArtista($tabla, $datos){

		//Aqui se  hace la conexion y se ingresa una categoria a la BD 
    	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_art = :nombre_art, edad = :edad, biografia = :biografia WHERE id = :id");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":nombre_art", $datos["nombre_art"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":edad", $datos["edad"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":biografia", $datos["biografia"], PDO::PARAM_STR);	

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

    static public function mdlBorrarArtista($tabla, $datos){

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