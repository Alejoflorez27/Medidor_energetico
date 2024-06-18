/*==============================
EDITAR CATEGORIA
==============================*/

$(".btnEditarAlbum").click(function(){

	//Creo una variable para guardar una variable post
	var idAlbum = $(this).attr("idAlbum");

	//Creo un objeto de tipo ajax llamado FormData en el cual va a guardar los datos
	var datos = new FormData();
	datos.append("idAlbum", idAlbum);

	$.ajax({

		//Creo el archivo de ajax para faciltar la comunicacion con la base de datos
		url: "ajax/albunes.ajax.php",
		method: "POST",
		data: datos,
		cache:false,
		contentType: false,
		processData: false,
		dataType: "json",

		success: function(respuesta){

			$("#editarAlbum").val(respuesta["nom_album"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarAno").val(respuesta["ano"]);
			$("#idAlbum").val(respuesta["id"]);
			//Para observar los datos tipo son
			//console.log("respuesta",respuesta);




		}


	})

})

/*==============================
ELIMINAR CATEGORIA
==============================*/

$(".btnEliminarAlbum").click(function(){

	//Creo una variable para guardar una variable post
	var idAlbum = $(this).attr("idAlbum");
 
	//Una alerta suave para borrar una categoria
	swal({

		title: '¿Está seguro de borrar el albúm?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar albúm!'
	 }).then((result)=>{

	 	//Si result viene en verdadero
	 	if(result.value){

	 		//esto es para una variable get para borrar desde el controlador endpoints
	 		window.location = "index.php?ruta=albunes&idAlbum="+idAlbum;

	 	}


	 })

})
