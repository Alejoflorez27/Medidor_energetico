    <!--Clase  en la cual van a ver dos secciones-->
    <div class="content-wrapper">
  <!--En esta seccion hay un contenido en encabezado de la cual hay una barra para volver a inicio-->
  <section class="content-header">

    <h1>

     Administrar Artistas

     <small>Panel de control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Artistas</li>

    </ol>

  </section>


  <!--Seccion en la cual va a ver un boton de agregar una categoría el cual utiliza un modal--> 
  <section class="content">

   <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarArtistas">
          
          Agregar Artistas
        </button>
    
      </div>

    <div class="box-body">
      
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
          
          <tr>
            
            <th style="width: 10px">#</th>
            <th>Artista</th>
            <th>Edad</th>
            <th>Biografia</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          //La siguiente variable solicita ya se mostrar un categoria o varias
          $artistas = ControladorArtistas::ctrMostrarArtistas($item, $valor);

          //Para revisar que trae artistas
          //var_dump($artistas);

          //El foreach lo hacemos devido a que existe un array
          foreach ($artistas as $key => $value) {
            
            echo '<tr>
            
                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre_art"].'</td>
                    <td class="text-uppercase">'.$value["edad"].'</td>
                    <td class="text-uppercase">'.$value["biografia"].'</td>

                    <td>
                      
                      <div class="btn-group">
                        
                        <button class="btn btn-warning btnEditarArtista" idArtista="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarArtista"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarArtista" idArtista="'.$value["id"].'"><i class="fa fa-times"></i></button>

                      </div>

                    </td>

                  </tr>';

          }


        ?>

        </tbody>

      </table>

    </div>

  </div>

</section>


</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
=======================================-->

<div id="modalAgregarArtistas" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar artista</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA ARTISTA-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoArtista" placeholder="Ingresar nombre" required>

              </div>

            </div>
            
            <!--ENTRADA PARA EDAD-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaEdad" placeholder="Ingresar Edad" required>

              </div>

            </div> 
            
            <!--ENTRADA PARA BIOGRAFIA-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaBiografia" placeholder="Ingresar biografia" required>

              </div>

            </div>            
   
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        =======================================-->

        <div class="modal-footer">

          <!--boton generico-->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!--boton de envio-->
          <button type="submit" class="btn btn-danger">Guardar Artista</button>

        </div>

        <?php
          //Creo el objeto de la clase ControladorArtistas y invoco un metodo de esa clase
          $crearArtista = new  ControladorArtistas();
          $crearArtista -> ctrCrearArtistas();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
=======================================-->

<div id="modalEditarArtista" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Artista</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA ARTISTA-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarArtista" id="editarArtista" required>

                <!--input oculto para guardar el id-->
                <input type="hidden" name="idArtista" id="idArtista" required>

              </div>

            </div>

            <!--ENTRADA PARA EDAD-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarEdad" id="editarEdad" required>

              </div>

            </div>

            <!--ENTRADA PARA BIOGRAFIA-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarBiografia" id="editarBiografia" required>

              </div>

            </div>
   
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        =======================================-->

        <div class="modal-footer">

          <!--boton generico-->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!--boton de envio-->
          <button type="submit" class="btn btn-danger">Guardar cambios</button>

        </div>

        <?php

          //Creo el objeto de la clase ControladorArtistas y invoco un metodo de esa clase
          $editarArtista = new  ControladorArtistas();
          $editarArtista -> ctrEditarArtista();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  //Creo el objeto de la clase ControladorArtistas y invoco un metodo de esa clase
  $borrarArtista = new  ControladorArtistas();
  $borrarArtista -> ctrBorrarArtista();

?>