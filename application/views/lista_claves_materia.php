<!DOCTYPE html>
<!-- Última revisión: 2012-02-12 08:30 p.m. -->

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
  <?php include 'elements/head.php'?> 
  <title>Lista de claves de acceso</title>
</head>
<body>
  <!-- Header -->
  <div class="row">
    <div class="twelve columns">
      <?php include 'elements/header.php'?>
    </div>
  </div>
  
  <div class="row">
    <!-- Nav Sidebar -->
    <div class="three columns">
      <!-- Panel de navegación -->
      <?php include 'elements/nav-sidebar.php'?>
    </div>  
    
    <!-- Main Section -->  
    <div id="Main" class="nine columns">
      <div class="row">
        <div class="twelve columns">
          <h3>Encuesta <?php echo $encuesta['año'].' / '.$encuesta['cuatrimestre']?></h3>
          <?php if(count($lista)== 0):?>
            <p>No se encontraron departamentos.</p>
          <?php else:?>
            <table class="twelve">
              <thead>
                <th>Clave</th>
                <th>Tipo</th>
                <th>Generada</th>
                <th>Utilizada</th>
              </thead>
              <?php foreach($lista as $item): ?>  
                <tr>
                  <td><a class="clave" href="<?php echo site_url('claves/ver/'.$item['departamento']->idDepartamento)?>"/><?php echo $item['departamento']->nombre?></a></td>
                  <td><?php echo $item['jefeDepartamento']->nombre.' '.$item['jefeDepartamento']->apellido?></td>
                  <td><a class="eliminar" href="#" value="<?php echo $item['departamento']->idDepartamento?>">Eliminar</a></td>
                </tr>
              <?php endforeach ?>
            </table>
          <?php endif ?>
          <?php echo $paginacion ?>
        </div>
      </div>
      <div class="row">
        <div class="twelve columns">
          <ul class="button-group">
            <li><a class="button" data-reveal-id="modalInforme">Generar informe</a></li>
            <li><a class="button" data-reveal-id="modalDevolucion">Escribir una devolución</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->    
  <div class="row">    
    <?php include 'elements/footer.php'?>
  </div>
  
  <!-- ventana modal para editar datos de la carrera -->
  <div id="modalInforme" class="reveal-modal medium">
    <?php
      //a donde mandar los datos editados para darse de alta
      //$link = site_url('carreras/modificar');  
      //include 'elements/form-editar-carrera.php'; 
    ?>
    <a class="close-reveal-modal">&#215;</a>
  </div>
    
  <!-- ventana modal para asociar materias a la carrera -->
  <div id="modalDevolucion" class="reveal-modal medium">
    <?php
      //a donde mandar los datos editados para darse de alta
      //$link = site_url('carreras/asociarMateria');  
      //include 'elements/form-asociar-materia.php'; 
    ?>
    <a class="close-reveal-modal">&#215;</a>
  </div>
    
  <!-- Included JS Files (Compressed) -->
  <script src="<?php echo base_url()?>js/foundation/foundation.min.js"></script>
  <!-- Initialize JS Plugins -->
  <script src="<?php echo base_url()?>js/foundation/app.js"></script>
  
  <script>
    $('.cancelar').click(function(){
      $('.cancelar').trigger('reveal:close'); //cerrar ventana
    });
    
    $('#listaMaterias').change(function(){
      $.ajax({
        type: "POST", 
        url: "<?php echo site_url('encuestas/listarClavesAJAX')?>", 
        data:{
          IdCarrera: $('#listaCarreras').val(),
          IdMateria: $(this).val(),
          IdEncuesta: <?php echo $encuesta['IdEncuesta']?>,
          IdFormulario: <?php echo $encuesta['IdFormulario']?>
        }
      }).done(function(msg){
        //si el servidor no envia datos
        if (msg.length == 0) return;
        //separo los datos separados en filas
        var filas = msg.split("\n");
        $('#tablaClaves').empty();
        $('#tablaClaves').append('<thead><th>Clave</th> <th>Tipo</th> <th>Generada</th> <th>Utilizada</th></thead>');
        for (var i=0; i<filas.length-1; i++){
          //separo datos en columnas
          var columnas = filas[i].split("\t");
          $('#tablaClaves').append(
            '<tr>'+
            '<td>'+columnas[0]+'</td>'+
            '<td>'+columnas[1]+'</td>'+
            '<td>'+columnas[2]+'</td>'+
            '<td>'+columnas[3]+'</td>'+
            '</tr>'
          );
        }
      });
    });
    
    $('#listaCarreras').change(function(){
      $.ajax({
        type: "POST", 
        url: "<?php echo site_url('carreras/listarMateriasAJAX')?>", 
        data:{IdCarrera: $(this).val()}
      }).done(function(msg){
        //si el servidor no envia datos
        if (msg.length == 0) return;
        //separo los datos separados en filas
        var filas = msg.split("\n");
        $('#listaMaterias').empty();
        for (var i=0; i<filas.length-1; i++){
          //separo datos en columnas
          var columnas = filas[i].split("\t");
          var id = columnas[0];
          var datos = columnas[1]+' ('+columnas[2]+')';
          //agregar fila a la lista desplegable
          $('#listaMaterias').append('<option value="'+id+'">'+datos+'</option>');
        }
      });
    });

    $.ajax({
      type: "POST", 
      url: "<?php echo site_url('carreras/listarAJAX')?>", 
      data:{}
    }).done(function(msg){
      //si el servidor no envia datos
      if (msg.length == 0) return;
      //separo los datos separados en filas
      var filas = msg.split("\n");
      $('#listaCarreras').empty();
      for (var i=0; i<filas.length-1; i++){
        //separo datos en columnas
        var columnas = filas[i].split("\t");
        var id = columnas[0];
        var datos = columnas[1]+' ('+columnas[2]+')';
        //agregar fila a la lista desplegable
        $('#listaCarreras').append('<option value="'+id+'">'+datos+'</option>');
      }
    });

    
  </script>
</body>
</html>