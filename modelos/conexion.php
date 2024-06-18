<?php

class Conexion{

	static public function conectar(){

		//se crea un objeto de tipo PDO (en el cual se le indica el localhost ademas el nombre de la base de datos;usuario BD;contraseña BD)
		$link = new PDO("mysql:host=localhost;dbname=pos",
						"root",
						"");

		//se le idica los simbolos a manejar
		$link -> exec("set names utf8");

		return $link;

	}

}