<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'templates/head.php'?>
  <title>Ver departamento</title>
  <script src="<?php echo base_url('js/bootstrap-typeahead.js')?>"></script>
</head>
<body>
  <div id="wrapper">
    <?php include 'templates/menu-nav.php'?>
    <div class="container">
      <div class="row">
        <!-- Titulo -->
        <div class="span12">
          <h3>Gestión de Departamentos, Carreras y Materias</h3>
          <p>---Descripción---</p>
        </div>
      </div>
      
      <div class="row">
        <!-- SideBar -->
        <div class="span3" id="menu">
          <h4>Navegación</h4>
          <ul class="nav nav-pills nav-stacked">      
            <li class="active"><a href="<?php echo site_url("departamentos")?>">Departamentos</a></li>
            <li><a href="<?php echo site_url("carreras")?>">Carreras</a></li>
            <li><a href="<?php echo site_url("materias")?>">Materias</a></li>
          </ul>
        </div>
        
        <!-- Main -->
        <div class="span9">
          <h3><?php echo $departamento->nombre?></h3>
          <p>Jefe de Departamento: <?php echo $jefeDepartamento->nombre.' '.$jefeDepartamento->apellido?></p>
  
          <!-- Botones -->
          <div class="btn-group">
            <button class="btn btn-primary" href="#modalModificar" role="button" data-toggle="modal">Modificar departamento...</button>
          </div>
        </div>
      </div>
    </div>
    <div id="push"></div><br />
  </div>
  <?php include 'templates/footer.php'?>  

  <!-- ventana modal para editar datos del departamento -->
  <div id="modalModificar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Editar departamento</h3>
    </div>
    <form class="form-horizontal" action="<?php echo site_url('departamentos/modificar')?>" method="post">
      <div class="modal-body">
        <?php include 'templates/form-editar-departamento.php'?>      
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        <input class="btn btn-primary" type="submit" name="submit" value="Aceptar" />
      </div>
    </form>
  </div>
  
  <!-- Le javascript -->
  <script src="<?php echo base_url('js/bootstrap-transition.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-modal.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-collapse.js')?>"></script>
  <script src="<?php echo base_url('js/bootstrap-dropdown.js')?>"></script>
  <script>
    //abrir automaticamente la ventana modal que contenga entradas con errores
    $('span.label-important').parentsUntil('.modal').parent().first().modal();
  </script>
</body>
</html>