<?php

require_once "conexion.php";

class ModeloProductos{

	/*====================================
	MOSTRAR PRODUCTOS
	=====================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if ($item != null) {//Cuando vamos a seleccionar un item en especifico

			//Preparamos la sentencia SQL para seleccionar de acuerdo al item
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
}