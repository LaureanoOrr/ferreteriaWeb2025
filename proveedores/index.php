<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/proveedores/listado_de_proveedores.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Listado de proveedores
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
              <i class="fa fa-plus"></i> Agregar nuevo
            </button>
          </h1>


        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->



  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Proveedores registrados</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <table id="example1" class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>
                    <center>N°</center>
                  </th>
                  <th>
                    <center>Nombre del proveedor</center>
                  </th>
                  <th>
                    <center>Teléfono</center>
                  </th>
                  <th>
                    <center>Email</center>
                  </th>
                  <th>
                    <center>Dirección</center>
                  </th>
                  <th>
                    <center>CUIT</center>
                  </th>
                  <th>
                    <center>Opciones</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $contador = 0;
                foreach ($proveedores_datos as $proveedores_dato) {
                  $id_proveedor =  $proveedores_dato['id_proveedor'];
                  $nombre_proveedor = $proveedores_dato['nombre_proveedor'] ?>
                  <tr>
                    <td>
                      <center><?php echo $contador = $contador + 1; ?></center>
                    </td>
                    <td><?php echo $proveedores_dato['nombre_proveedor'] ?></td>
                    <td><?php echo $proveedores_dato['telefono'] ?></td>
                    <td><?php echo $proveedores_dato['email'] ?></td>
                    <td><?php echo $proveedores_dato['direccion'] ?></td>
                    <td><?php echo $proveedores_dato['cuit'] ?></td>
                    <td>
                      <center>
                        <div class="btn-group">


                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_proveedor ?>">
                            <i class="fa fa-pencil-alt"></i> Editar
                          </button>

                          <!--- Modal para actualizar proveedor--->

                          <div class="modal fade" id="modal-update<?php echo $id_proveedor ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #28A745; color: white">
                                  <h4 class="modal-title">Actualización del proveedor</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="">Nombre del proveedor<b>*</b></label>
                                        <input type="text" id="nombre_proveedor<?php echo $id_proveedor ?>" value="<?php echo $nombre_proveedor ?>" class="form-control" required>
                                        <small style="color: red ; display: none" id="lbl_nombre<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Telefono<b>*</b></label>
                                        <input type="number" id="telefono<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['telefono'] ?>" class="form-control" required>
                                        <small style="color: red ; display: none" id="lbl_telefono<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Email<b>*</b></label>
                                        <input type="email" id="email<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['email']  ?>" class="form-control" required>
                                        <small style="color: red ; display: none" id="lbl_email<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Dirección<b>*</b></label>
                                        <input type="text" id="direccion<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['direccion'] ?>" class="form-control" required>
                                        <small style="color: red ; display: none" id="lbl_direccion<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">CUIT<b>*</b></label>
                                        <input type="number" id="cuit<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['cuit'] ?>" class="form-control" required>
                                        <small style="color: red ; display: none" id="lbl_cuit<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div id="respuesta"></div>
                                    </div>



                                  </div>



                                </div>

                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" class="btn btn-success" id="btn_update<?php echo $id_proveedor ?>">Actualizar</button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                          <script>
                            $('#btn_update<?php echo $id_proveedor ?>').click(function() {
                              var id_proveedor = '<?php echo $id_proveedor ?>';
                              var nombre_proveedor = $('#nombre_proveedor<?php echo $id_proveedor ?>').val();
                              var telefono = $('#telefono<?php echo $id_proveedor ?>').val();
                              var email = $('#email<?php echo $id_proveedor ?>').val();
                              var direccion = $('#direccion<?php echo $id_proveedor ?>').val();
                              var cuit = $('#cuit<?php echo $id_proveedor ?>').val();
                              

                              if (nombre_proveedor === '') {
                                $('#nombre_proveedor<?php echo $id_proveedor ?>').focus();
                                $('#lbl_nombre<?php echo $id_proveedor ?>').css('display', 'block');

                              } else if (telefono === '') {
                                $('#telefono<?php echo $id_proveedor ?>').focus();
                                $('#lbl_telefono<?php echo $id_proveedor ?>').css('display', 'block');

                              } else if (email === '') {
                                $('#email<?php echo $id_proveedor ?>').focus();
                                $('#lbl_email<?php echo $id_proveedor ?>').css('display', 'block');

                              } else if (direccion === '') {
                                $('#direccion<?php echo $id_proveedor ?>').focus();
                                $('#lbl_direccion<?php echo $id_proveedor ?>').css('display', 'block');
                              } else if (cuit === '') {
                                $('#cuit<?php echo $id_proveedor ?>').focus();
                                $('#lbl_cuit<?php echo $id_proveedor ?>').css('display', 'block');

                              } else {
                                var url = "../app/controllers/proveedores/update.php";
                                $.get(url, {
                                  id_proveedor:id_proveedor, nombre_proveedor: nombre_proveedor,
                                  telefono: telefono,
                                  email: email,
                                  direccion: direccion,
                                  cuit: cuit
                                }, function(datos) {
                                  $('#respuesta').html(datos);
                                })
                              }

                            });
                          </script>
                          <div id="repuesta_update<?php echo $id_proveedor?>"></div>




                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_proveedor ?>">
                            <i class="fa fa-trash"></i> Eliminar
                          </button>

                          <!--- Modal para eliminar proveedor--->

                          <div class="modal fade" id="modal-delete<?php echo $id_proveedor ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #cd5151; color: white">
                                  <h4 class="modal-title">¿Esta seguro de eliminar el proveedor?</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="">Nombre del proveedor<b>*</b></label>
                                        <input type="text" id="nombre_proveedor<?php echo $id_proveedor ?>" value="<?php echo $nombre_proveedor ?>" class="form-control" disabled>
                                        <small style="color: red ; display: none" id="lbl_nombre<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Telefono<b>*</b></label>
                                        <input type="number" id="telefono<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['telefono'] ?>" class="form-control" disabled>
                                        <small style="color: red ; display: none" id="lbl_telefono<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Email<b>*</b></label>
                                        <input type="email" id="email<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['email']  ?>" class="form-control" disabled>
                                        <small style="color: red ; display: none" id="lbl_email<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Dirección<b>*</b></label>
                                        <input type="text" id="direccion<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['direccion'] ?>" class="form-control" disabled>
                                        <small style="color: red ; display: none" id="lbl_direccion<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="">CUIT<b>*</b></label>
                                        <input type="number" id="cuit<?php echo $id_proveedor ?>" value="<?php echo $proveedores_dato['cuit'] ?>" class="form-control" disabled>
                                        <small style="color: red ; display: none" id="lbl_cuit<?php echo $id_proveedor ?>">* Este campo es obligatorio</small>
                                      </div>
                                      <div id="respuesta"></div>
                                    </div>



                                  </div>



                                </div>

                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                  <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_proveedor ?>">Eliminar</button>
                                </div>
                                <div id="repuesta"></div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                          <script>
                            $('#btn_delete<?php echo $id_proveedor ?>').click(function() {
                              var id_proveedor = '<?php echo $id_proveedor ?>';
                            
                                var url2 = "../app/controllers/proveedores/delete.php";
                                $.get(url2, { id_proveedor:id_proveedor }, function(datos) {
                                  $('#respuesta').html(datos);
                                });
                              }
                            );
                          </script>
                          

                        </div>
                      </center>
                    </td>
                  </tr>
                <?php
                }

                ?>
              </tbody>

              <tfoot>

              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

  </div>


  <!-- /.row -->
  <!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include('../layout/mensajes.php');
include('../layout/parte2.php');
?>

<script>
  $(function() {
    $("#example1").DataTable({
      "pageLength": 5,
      language: {
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
        "infoEmpty": "Mostrando 0 a 0 de 0 proveedores",
        "infoFiltered": "(Filtrado de MAX total Proveedores)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Proveedores",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscador:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },

      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      /* Ajuste de botones */
      buttons: [{
          extend: 'collection',
          text: 'Reportes',
          orientation: 'landscape',
          buttons: [{
            text: 'Copiar',
            extend: 'copy'
          }, {
            extend: 'pdf',
          }, {
            extend: 'csv',
          }, {
            extend: 'excel',
          }, {
            text: 'Imprimir',
            extend: 'print'
          }]
        },
        {
          extend: 'colvis',
          text: 'Visualizar las columnas'
        }
      ],

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>

<!--- Modal para registrar nuevo proveedor--->

<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #007BFF; color: white">
        <h4 class="modal-title">Creación de un nuevo proveedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nombre del proveedor<b>*</b></label>
              <input type="text" id="nombre_proveedor" class="form-control" required>
              <small style="color: red ; display: none" id="lbl_nombre">* Este campo es obligatorio</small>
            </div>
            <div class="form-group">
              <label for="">Telefono<b>*</b></label>
              <input type="number" id="telefono" class="form-control" required>
              <small style="color: red ; display: none" id="lbl_telefono">* Este campo es obligatorio</small>
            </div>
            <div class="form-group">
              <label for="">Email<b>*</b></label>
              <input type="email" id="email" class="form-control" required>
              <small style="color: red ; display: none" id="lbl_email">* Este campo es obligatorio</small>
            </div>
            <div class="form-group">
              <label for="">Dirección<b>*</b></label>
              <input type="text" id="direccion" class="form-control" required>
              <small style="color: red ; display: none" id="lbl_direccion">* Este campo es obligatorio</small>
            </div>
            <div class="form-group">
              <label for="">CUIT<b>*</b></label>
              <input type="number" id="cuit" class="form-control" required>
              <small style="color: red ; display: none" id="lbl_cuit">* Este campo es obligatorio</small>
            </div>
            <div id="respuesta"></div>
          </div>



        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_create">Guardar proveedor</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script>
  $('#btn_create').click(function() {
    var nombre_proveedor = $('#nombre_proveedor').val();
    var telefono = $('#telefono').val();
    var email = $('#email').val();
    var direccion = $('#direccion').val();
    var cuit = $('#cuit').val();


    if (nombre_proveedor === '') {
      $('#nombre_proveedor').focus();
      $('#lbl_nombre').css('display', 'block');

    } else if (telefono === '') {
      $('#telefono').focus();
      $('#lbl_telefono').css('display', 'block');

    } else if (email === '') {
      $('#email').focus();
      $('#lbl_email').css('display', 'block');

    } else if (direccion === '') {
      $('#direccion').focus();
      $('#lbl_direccion').css('display', 'block');
    } else if (cuit === '') {
      $('#cuit').focus();
      $('#lbl_cuit').css('display', 'block');

    } else {
      var url = "../app/controllers/proveedores/create.php";
      $.get(url, {
        nombre_proveedor: nombre_proveedor,
        telefono: telefono,
        email: email,
        direccion: direccion,
        cuit: cuit
      }, function(datos) {
        $('#respuesta').html(datos);
      })
    }

  });
</script>