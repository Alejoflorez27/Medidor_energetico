/*==============================
EDITAR ARTISTA
==============================*/

$(".btnEditarArtista").click(function(){

	//Creo una variable para guardar una variable post
	var idArtista = $(this).attr("idArtista");

	//Creo un objeto de tipo ajax llamado FormData en el cual va a guardar los datos
	var datos = new FormData();
	datos.append("idArtista", idArtista);

	$.ajax({

		//Creo el archivo de ajax para faciltar la comunicacion con la base de datos
		url: "ajax/artistas.ajax.php",
		method: "POST",
		data: datos,
		cache:false,
		contentType: false,
		processData: false,
		dataType: "json",

		success: function(respuesta){

			$("#editarArtista").val(respuesta["nombre_art"]);
			$("#editarEdad").val(respuesta["edad"]);
			$("#editarBiografia").val(respuesta["biografia"]);
			$("#idArtista").val(respuesta["id"]);
			//Para observar los datos tipo son
			//console.log("respuesta",respuesta);




		}


	})

})

/*==============================
ELIMINAR CATEGORIA
==============================*/

$(".btnEliminarArtista").click(function(){

	//Creo una variable para guardar una variable post
	var idArtista = $(this).attr("idArtista");
 
	//Una alerta suave para borrar una categoria
	swal({

		title: '¿Está seguro de borrar el artista?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar artista!'
	 }).then((result)=>{

	 	//Si result viene en verdadero
	 	if(result.value){

	 		//esto es para una variable get para borrar desde el controlador endpoints
	 		window.location = "index.php?ruta=artistas&idArtista="+idArtista;

	 	}


	 })

})
