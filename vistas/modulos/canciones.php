    <!--Clase  en la cual van a ver dos secciones-->
    <div class="content-wrapper">
  <!--En esta seccion hay un contenido en encabezado de la cual hay una barra para volver a inicio-->
  <section class="content-header">

    <h1>

     Administrar Canciones

     <small>Panel de control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Canciones</li>

    </ol>

  </section>


  <!--Seccion en la cual va a ver un boton de agregar una categoría el cual utiliza un modal--> 
  <section class="content">

   <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarCanciones">
          
          Agregar canciones
        </button>
    
      </div>

    <div class="box-body">
      
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
          
          <tr>
            
            <th style="width: 10px">#</th>
            <th>Canciones</th>
            <th>Descripción</th>
            <th>Año</th>
            <th>Genero</th>
            <th>Album</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          //La siguiente variable solicita ya se mostrar un canciones o varias
          $canciones = ControladorCanciones::ctrMostrarCanciones($item, $valor);

          //Para revisar que trae categorias
          //var_dump($canciones);

          //El foreach lo hacemos devido a que existe un array
          foreach ($canciones as $key => $value) {
            
            echo '<tr>
            
                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nom_cancion"].'</td>
                    <td class="text-uppercase">'.$value["descripcion"].'</td>
                    <td class="text-uppercase">'.$value["ano"].'</td>';

                    $item = "id";
                    $valor = $value["id_genero"];

                    //Solicitamos una respuesta de la categoria reciclado metodos
                    $genero = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    echo '<td class="text-uppercase">'.$genero["nom_genero"].'</td>';

                    $item = "id";
                    $valor = $value["id_album"];

                    //Solicitamos una respuesta de la categoria reciclado metodos
                    $album = ControladorAlbunes::ctrMostrarAlbunes($item, $valor);

                    echo '<td class="text-uppercase">'.$album["nom_album"].'</td>                    


                    <td>
                      
                      <div class="btn-group">
                        
                        <button class="btn btn-warning btnEditarCanciones" idCancion="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCanciones"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarCanciones" idCancion="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR CANCIONES
=======================================-->

<div id="modalAgregarCanciones" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Canciones</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA CANCIONES-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCancion" placeholder="Ingresar Canción" required>

              </div>

            </div>
            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripcion" required>

              </div>

            </div>
            
            <!--ENTRADA PARA AÑO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input-lg" name="nuevaAno" placeholder="Ingresar Año" required>

              </div>

            </div>
            

            <!-- ENTRADA PARA GENERO -->
            <div class="form-group">

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="nuevoGenero" name="nuevoGenero" required>

                  <option value="">Selecionar Genero</option>

                    <?php
                    $item = null;
                    $valor = null;
                    $generos = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                    foreach ($generos as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["nom_genero"] . '</option>';
                    }
                    ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA ALBUNES -->
            <div class="form-group">

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="nuevoAlbun" name="nuevoAlbun" required>

                  <option value="">Selecionar Albunes</option>

                    <?php
                    $item = null;
                    $valor = null;
                    $albunes = ControladorAlbunes::ctrMostrarAlbunes($item, $valor);
                    foreach ($albunes as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["nom_album"] . '</option>';
                    }
                    ?>
                    
                </select>

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
          <button type="submit" class="btn btn-danger">Guardar Genero</button>

        </div>

        <?php
          //Creo el objeto de la clase ControladorCategorias y invoco un metodo de esa clase
          $crearCancion = new  ControladorCanciones();
          $crearCancion -> ctrCrearCanciones();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CANCIONES
=======================================-->

<div id="modalEditarCanciones" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Canciones</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA CANCIONES-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarCancion" id="editarCancion" required>

                <!--input oculto para guardar el id-->
                <input type="hidden" name="idCancion" id="idCancion" required>

              </div>

            </div>

            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>

              </div>

            </div>

            <!--ENTRADA PARA AÑO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input-lg" name="editarAno" id="editarAno" required>

              </div>

            </div>

            <!-- ENTRADA PARA GENERO -->
            <div class="form-group">

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="editarGenero" name="editarGenero" required>

                  <option value="">Selecionar Genero</option>

                    <?php
                    $item = null;
                    $valor = null;
                    $generos = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                    foreach ($generos as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["nom_genero"] . '</option>';
                    }
                    ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA ALBUNES -->
            <div class="form-group">

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="editarAlbun" name="editarAlbun" required>

                  <option value="">Selecionar Albunes</option>

                    <?php
                    $item = null;
                    $valor = null;
                    $albunes = ControladorAlbunes::ctrMostrarAlbunes($item, $valor);
                    foreach ($albunes as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["nom_album"] . '</option>';
                    }
                    ?>
                    
                </select>

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

          //Creo el objeto de la clase ControladorCategorias y invoco un metodo de esa clase
          $editarCancion = new  ControladorCanciones();
          $editarCancion -> ctrEditarCanciones();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  //Creo el objeto de la clase ControladorCategorias y invoco un metodo de esa clase
  $borrarCancion = new  ControladorCanciones();
  $borrarCancion -> ctrBorrarCanciones();

?>