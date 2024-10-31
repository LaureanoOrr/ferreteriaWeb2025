<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/listado_de_productos_inactivos.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Listado de productos inactivos </h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->



  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Productos INACTIVOS</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>
                      <center>N°</center>
                    </th>
                    <th>
                      <center>Código</center>
                    </th>
                    <th>
                      <center>Categoría</center>
                    </th>
                    <th>
                      <center>Nombre</center>
                    </th>
                    <th>
                      <center>Descripción</center>
                    </th>
                    <th>
                      <center>Stock</center>
                    </th>
                    <th>
                      <center>Precio compra</center>
                    </th>
                    <th>
                      <center>Precio venta</center>
                    </th>
                    <th>
                      <center>Disponible</center>
                    </th>
                    <th>
                      <center>Opciones</center>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 0;
                  foreach ($productos_datos as $productos_dato) {
                    $id_producto = $productos_dato['id_producto']; ?>
                    <tr>
                      <td><?php echo $contador = $contador + 1 ?></td>
                      <td><?php echo $productos_dato['codigo'] ?></td>
                      <td><?php echo $productos_dato['nombre_categoria'] ?></td>
                      <td><?php echo $productos_dato['nombre'] ?></td>
                      <td><?php echo $productos_dato['descripcion'] ?></td>
                      <td style=" font-weight: bold; "><center><?php echo $productos_dato['stock'] ?></td></center>
                      
                     


                      <td><?php echo '$' . $productos_dato['precio_compra'] ?></td>
                      <td><?php echo '$' . $productos_dato['precio_venta'] ?></td>
                      <td><?php echo $productos_dato['estado'] ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="show.php?id=<?php echo $id_producto ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                          <a href="update.php?id=<?php echo $id_producto ?>" type="button" class="btn btn-success  btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                        </div>
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
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
        "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
        "infoFiltered": "(Filtrado de MAX total Productos)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ productos",
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