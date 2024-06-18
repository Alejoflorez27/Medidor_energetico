<?php

require_once "conexion.php";

class ModeloAlbunes{

	/*================================
	CREAR CATEGORÍA
    ==================================

    static public function mdlIngresarAlbunes($tabla, $datos){

		//Aqui se  hace la conexion y se ingresa una categoria a la BD 
    	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nom_album, descripcion, ano) VALUES (:nom_album, :descripcion, :ano)");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":nom_album", $datos["nom_album"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_INT);

		if ($stmt ->execute()) {
			
			return "ok";

		}else{

			return "error";

		}

		//Cerramos la conexion a la BD
		$stmt -> close();

		//La ponemos en vacio para la instancia de conexion
		$stmt = null;

    }*/

	/*================================
	CREAR CATEGORÍA
    ==================================*/

    static public function mdlIngresarAlbunes($tabla, $datos){
		//print_r($datos);

		//Aqui se  hace la conexion y se ingresa una categoria a la BD 
    	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(IdDimension, Fecha, Numerador, Denominador, DescripcionIndicador, Valor) VALUES (:IdDimension, :Fecha, :Numerador, :Denominador, :DescripcionIndicador :Valor)");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":IdDimension", $datos["IdDimension"], PDO::PARAM_STR);
		//Pasa valores para ejecutar
		$stmt -> bindParam(":Fecha", $datos["Fecha"], PDO::PARAM_STR);
		//Pasa valores para ejecutar
		$stmt -> bindParam(":Numerador", $datos["Numerador"], PDO::PARAM_INT);
		//Pasa valores para ejecutar
		$stmt -> bindParam(":Denominador", $datos["Denominador"], PDO::PARAM_INT);
		//Pasa valores para ejecutar
		$stmt -> bindParam(":DescripcionIndicador", $datos["DescripcionIndicador"], PDO::PARAM_STR);
		//Pasa valores para ejecutar
		$stmt -> bindParam(":Valor", $datos["Valor"], PDO::PARAM_STR);

		//print_r($stmt);

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
	MOSTAR CATEGORIAS
    ==================================*/
    static public function mdlMostrarAlbunes($tabla, $item, $valor){

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

    static public function mdlEditarAlbunes($tabla, $datos){

		//Aqui se  hace la conexion y se ingresa una categoria a la BD 
    	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nom_album = :nom_album, descripcion = :descripcion, ano = :ano WHERE id = :id");

		//Pasa valores para ejecutar
		$stmt -> bindParam(":nom_album", $datos["nom_album"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		//Pasa valores para ejecutar
		$stmt -> bindParam(":ano", $datos["ano"], PDO::PARAM_INT);		

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

    static public function mdlBorrarAlbunes($tabla, $datos){

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