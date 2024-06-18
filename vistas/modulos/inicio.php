  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
      SISTEMA DE TELEMETRÍA PARA ANÁLISIS DE PARÁMETROS ENERGÉTICOS DE BAJA POTENCIA A TRAVÉS DE INTERNET DE LAS COSAS
      </h5>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Inicio</a></li>
              <li><a href="#timeline" data-toggle="tab">Corriente</a></li>
              <li><a href="#settings" data-toggle="tab">Voltage</a></li>
              <li><a href="#Artistas" data-toggle="tab">Frecuencia</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                  <h1>Dashboard</h1>
                  <?php include "monitor_tabla.php"?>
                  <?php //include "monitor.php" 
                  //include "graficaCorriente.php"
                  //include "reproductor.php" ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <?php include "monitor_corriente.php"?>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                  <h1>Voltaje</h1>
                  <?php include "monitor_voltaje.php"?>
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
              <div class="tab-pane" id="Artistas">
                <h1>Frecuencia</h1>
                <?php include "monitor_frecuencia.php"?>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>