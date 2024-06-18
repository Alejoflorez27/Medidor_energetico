/*==============================
EDITAR CATEGORIA
==============================*/

$(".btnEditarCanciones").click(function(){

	//Creo una variable para guardar una variable post
	var idCancion = $(this).attr("idCancion");

	//Creo un objeto de tipo ajax llamado FormData en el cual va a guardar los datos
	var datos = new FormData();
	datos.append("idCancion", idCancion);

	$.ajax({

		//Creo el archivo de ajax para faciltar la comunicacion con la base de datos
		url: "ajax/canciones.ajax.php",
		method: "POST",
		data: datos,
		cache:false,
		contentType: false,
		processData: false,
		dataType: "json",

		success: function(respuesta){

			$("#editarCancion").val(respuesta["nom_cancion"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarAno").val(respuesta["ano"]);
			$("#editarGenero").val(respuesta["id_genero"]);
			$("#editarAlbun").val(respuesta["id_album"]);
			$("#idCancion").val(respuesta["id"]);
			//Para observar los datos tipo son
			console.log("respuesta",respuesta);




		}


	})

})

/*==============================
ELIMINAR CATEGORIA
==============================*/

$(".btnEliminarCanciones").click(function(){

	//Creo una variable para guardar una variable post
	var idCancion = $(this).attr("idCancion");
 
	//Una alerta suave para borrar una categoria
	swal({

		title: '¿Está seguro de borrar el genero?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar genero!'
	 }).then((result)=>{

	 	//Si result viene en verdadero
	 	if(result.value){

	 		//esto es para una variable get para borrar desde el controlador endpoints
	 		window.location = "index.php?ruta=canciones&idCancion="+idCancion;

	 	}


	 })

})
