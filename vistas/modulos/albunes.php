    <!--Clase  en la cual van a ver dos secciones-->
    <div class="content-wrapper">
  <!--En esta seccion hay un contenido en encabezado de la cual hay una barra para volver a inicio-->
  <section class="content-header">

    <h1>

     Administrar Albunes

     <small>Panel de control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Albunes</li>

    </ol>

  </section>


  <!--Seccion en la cual va a ver un boton de agregar una categoría el cual utiliza un modal--> 
  <section class="content">

   <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarAlbunes">
          
          Agregar Albunes
        </button>
    
      </div>

    <div class="box-body">
      
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
          
          <tr>
            
            <th style="width: 10px">#</th>
            <th>IdDimension</th>
            <th>Fecha</th>
            <th>Numerador</th>
            <th>Denominador</th>
            <th>Descripcion Indicador</th>
            <th>Valor</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          //La siguiente variable solicita ya se mostrar un categoria o varias
          $albunes = ControladorAlbunes::ctrMostrarAlbunes($item, $valor);

          //Para revisar que trae categorias
          //var_dump($albunes);

          //El foreach lo hacemos devido a que existe un array
          foreach ($albunes as $key => $value) {
            
            echo '<tr>
            
                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["IdDimension"].'</td>
                    <td class="text-uppercase">'.$value["Fecha"].'</td>
                    <td class="text-uppercase">'.$value["Numerador"].'</td>
                    <td class="text-uppercase">'.$value["Denominador"].'</td>
                    <td class="text-uppercase">'.$value["DescripcionIndicador"].'</td>
                    <td class="text-uppercase">'.$value["Valor"].'</td>


                    <td>
                      
                      <div class="btn-group">
                        
                        <button class="btn btn-warning btnEditarAlbum" idAlbum="'.$value["Id"].'" data-toggle="modal" data-target="#modalEditarAlbunes"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarAlbum" idAlbum="'.$value["Id"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR ALBUM
=======================================-->

<div id="modalAgregarAlbunes" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Albúm</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA CATEGORIAS-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="IdDimension" placeholder="Ingresar Dimension" required>

              </div>

            </div>
            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="Fecha" placeholder="Ingresar Fecha" required>

              </div>

            </div>
            
            <!--ENTRADA PARA AÑO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input-lg" name="Numerador" placeholder="Ingresar Numerador" required>

              </div>

            </div>  
            <!--ENTRADA PARA AÑO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input-lg" name="Denominador" placeholder="Ingresar Año" required>

              </div>

            </div> 

            <!--ENTRADA PARA AÑO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="DescripcionIndicador" placeholder="Descripcion Indicador" required>

              </div>

            </div>
            <!--ENTRADA PARA AÑO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="Valor" placeholder="Valor" required>

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
          $crearAlbum = new  ControladorAlbunes();
          $crearAlbum -> ctrCrearAlbunes();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
=======================================-->

<div id="modalEditarAlbunes" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Album</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA CATEGORIAS-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarAlbum" id="editarAlbum" required>

                <!--input oculto para guardar el id-->
                <input type="hidden" name="idAlbum" id="idAlbum" required>

              </div>

            </div>

            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>

              </div>

            </div>

            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input-lg" name="editarAno" id="editarAno" required>

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
          $editarAlbum = new  ControladorAlbunes();
          $editarAlbum -> ctrEditarAlbunes();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  //Creo el objeto de la clase ControladorCategorias y invoco un metodo de esa clase
  $borrarAlbum = new  ControladorAlbunes();
  $borrarAlbum -> ctrBorrarAlbunes();

?>