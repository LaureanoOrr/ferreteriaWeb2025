<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/ventas/listado_de_ventas.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Listado de Ventas</h1>
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
            <h3 class="card-title">Ventas registradas</h3>

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
                      <center>N° venta</center>
                    </th>
                    <th>
                      <center>Productos</center>
                    </th>
                    <th>
                      <center>Clientes</center>
                    </th>
                    <th>
                      <center>Total</center>
                    </th>
                    <th>
                      <center>Método de pago</center>
                    </th>
                    <th>
                      <center>Opciones</center>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 0;
                  foreach ($ventas_datos as $ventas_dato) {
                    $id_venta = $ventas_dato['id_venta'];
                    $id_cliente = $ventas_dato['id_cliente'];
                    $contador = $contador + 1;
                  ?>
                    <tr>
                      <td>
                        <center><?php echo $contador ?> </center>
                      </td>
                      <td>
                        <center><?php echo  $ventas_dato['nro_venta'] ?> </center>
                      </td>
                      <td>
                        <center>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_venta ?>">
                            Productos
                          </button>

                          <!-- Modal Productos -->
                          <div class="modal fade" id="Modal_productos<?php echo $id_venta ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #17a2b8; color: white">
                                  <h5 class="modal-title" id="exampleModalLabel">Productos de la venta N°<?php echo  $ventas_dato['nro_venta'] ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="table-responsive">
                                    <table class="table table-bordered table-sm table-hover table-striped">
                                      <thead>
                                        <tr>
                                          <th style="background-color: #e7e7e7; text-align:center">Nro</th>
                                          <th style="background-color: #e7e7e7; text-align:center">Productos</th>
                                          <th style="background-color: #e7e7e7; text-align:center">Descripción</th>
                                          <th style="background-color: #e7e7e7; text-align:center">Cantidad</th>
                                          <th style="background-color: #e7e7e7; text-align:center">Precio unitario</th>
                                          <th style="background-color: #e7e7e7; text-align:center">Precio SubTOTAL</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $contador_de_carrito = 0;
                                        $cantidad_total = 0;
                                        $precio_unitario_total = 0;
                                        $precio_total = 0;
                                        $nro_venta = $ventas_dato['nro_venta'];
                                        $metoddo_pago = $ventas_dato['metodo_pago'];

                                        $sql_carrito = "SELECT * , pro.nombre as nombre_producto , pro.descripcion as descripcion_producto, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto  FROM tb_carrito as carr INNER JOIN tb_almacen as pro
                                    ON carr.id_producto = pro.id_producto WHERE nro_venta = '$nro_venta' ORDER BY id_carrito ASC";
                                        $query_carrito = $pdo->prepare($sql_carrito);
                                        $query_carrito->execute();
                                        $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($carrito_datos as $carrito_dato) {
                                          $id_carrito = $carrito_dato['id_carrito'];
                                          $contador_de_carrito = $contador_de_carrito + 1;
                                          $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
                                          $precio_unitario_total = $precio_unitario_total + floatval($carrito_dato['precio_venta']);
                                        ?>

                                          <tr>
                                            <td>
                                              <center><?php echo $contador_de_carrito ?></center>
                                              <input type="text" value="<?php echo $carrito_dato['id_producto']; ?>" id="id_producto_carrito<?php echo $contador_de_carrito; ?>" hidden>

                                            </td>
                                            <td> <?php echo $carrito_dato['nombre_producto'] ?></td>
                                            <td> <?php echo $carrito_dato['descripcion_producto'] ?></td>
                                            <td>
                                              <center><span id="cantidad_carrito<?php echo $contador_de_carrito ?>"><?php echo $carrito_dato['cantidad'] ?></span></center>
                                              <input type="text" value="<?php echo $carrito_dato['stock'] ?>" id="stock_inventario<?php echo $contador_de_carrito ?>" hidden>
                                            </td>
                                            <td>
                                              <center><?php echo '$' . $carrito_dato['precio_venta'] ?></center>
                                            </td>
                                            <td>
                                              <center>
                                                <?php
                                                $cantidad = floatval($carrito_dato['cantidad']);
                                                $precio_venta = floatval($carrito_dato['precio_venta']);
                                                $subtotal = $cantidad * $precio_venta;
                                                echo '$' . $subtotal;
                                                $precio_total = $precio_total + $subtotal;

                                                ?>
                                              </center>
                                            </td>

                                          </tr>

                                        <?php
                                        }
                                        ?>




                                        <tr>
                                          <th colspan="3" style="background-color: #e7e7e7; text-align:right"> TOTAL</th>
                                          <th>
                                            <center>
                                              <?php echo $cantidad_total; ?>
                                            </center>
                                          </th>
                                          <th>
                                            <center><?php echo '$' . $precio_unitario_total ?></center>
                                          </th>
                                          <th style="background-color: #cfe6ff;">
                                            <center id="precio_total_final"><?php echo '$' . $precio_total ?></center>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th colspan="5" style=" text-align:right"> Método de Pago</th>
                                          <td>
                                            <center><?php echo $metoddo_pago ?></center>
                                          </td>
                                        </tr>




                                      </tbody>

                                    </table>
                                  </div>




                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </center>
                      </td>
                      <td>
                        <center>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_clientes<?php echo $id_venta ?>">
                            <?php echo $ventas_dato['nombre_cliente']; ?>
                          </button>

                          <!-- Modal datos cliente -->
                          <div class="modal fade" id="Modal_clientes<?php echo $id_venta ?>">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: #17a2b8; color: white">
                                  <h4 class="modal-title"> Datos del cliente </h4>

                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>

                                <div class="modal-body">
                                <?php
                                $sql_clientes= "SELECT * FROM tb_clientes where id_cliente = $id_cliente ";
                                $query_clientes = $pdo->prepare($sql_clientes);
                                $query_clientes->execute();
                                $clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($clientes_datos as $clientes_dato){
                                  $nombre_cliente = $clientes_dato['nombre_cliente'];
                                  $dni_cliente = $clientes_dato['dni_cliente'];
                                  $celular_cliente = $clientes_dato['celular_cliente'];
                                  $email_cliente = $clientes_dato['email_cliente'];
                                }
                                ?>


                                  <div class="form-group">
                                    <label for="">Nombre del Cliente</label>
                                    <input type="text" value="<?php echo $nombre_cliente?>" name="nombre_cliente" class="form-control" disabled>
                                  </div>
                                  <div class="form-group">
                                    <label for="">DNI </label>
                                    <input type="text" value="<?php echo $dni_cliente?>" name="dni_cliente" class="form-control" disabled>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Teléfono </label>
                                    <input type="text" value="<?php echo $celular_cliente?>"  name="celular_cliente" class="form-control" disabled>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Email </label>
                                    <input type="email" value="<?php echo $email_cliente?>" name="email_cliente" class="form-control" disabled>
                                  </div>
                                  <hr>






                                </div>

                              </div>

                              <div>

                              </div>
                              <div id="repuesta"></div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->

                          <!-- /.modal -->
                        </center>
                      </td>
                      <td>
                        <center><?php echo "$" . $ventas_dato['total_pagado'] ?> </center>
                      </td>
                      <td>
                        <center><?php echo  $ventas_dato['metodo_pago'] ?> </center>
                      </td>
                      <td>
                        <center>
                          <a href="show.php?id_venta=<?php echo $id_venta?>" class="btn btn-info">Ver</a>
                          <a href="delete.php?id_venta=<?php echo $id_venta?>&nro_venta=<?php echo $nro_venta?>" class="btn btn-danger">Borrar</a>
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
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
        "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
        "infoFiltered": "(Filtrado de MAX total Compras)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ compras",
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