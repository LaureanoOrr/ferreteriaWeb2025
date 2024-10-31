<?php
 $id_venta_get = $_GET['id_venta'];
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/ventas/cargar_venta.php');
include('../app/controllers/clientes/cargar_cliente.php');

?>

<!-- Contenedor principal -->
<div class="content-wrapper">
    <!-- Encabezado de la página -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Detalle de la venta N° <?php echo $nro_venta?>  </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Contenido principal -->
    <div class="content">
        <div class="container-fluid">
            <!-- detalle venta -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                          
                            <h3 class="card-title"> <i class="fa fa-shopping-bag"></i> Detalle de venta N° <input type="text" value="<?php echo $nro_venta ?>" style="text-align: center" disabled></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                     

                        <!--- Tabla detalle de venta--->

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
                                   



                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- datos cliente -->

        <div class="row">
            <div class="col-md-9">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fa fa-user"></i> Datos del cliente </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>

                    <?php 
                    foreach ($clientes_datos as $clientes_dato){
                        $nombre_cliente = $clientes_dato['nombre_cliente'];
                        $dni_cliente = $clientes_dato['dni_cliente'];
                        $celular_cliente = $clientes_dato['celular_cliente'];
                        $email_cliente = $clientes_dato['email_cliente'];
                    }
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" id="id_cliente" hidden>
                                    <label for="">Nombre del cliente</label>
                                    <input type="text" value="<?php echo $nombre_cliente ?>" class="form-control" id="nombre_cliente" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">DNI </label>
                                    <input type="text"  value="<?php echo $dni_cliente ?>" class="form-control" id="dni_cliente" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Teléfono </label>
                                    <input type="text"  value="<?php echo $celular_cliente ?>" class="form-control" id="celular_cliente" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text"  value="<?php echo $email_cliente ?>" class="form-control" id="email_cliente" disabled>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>

            </div>

            <div class="col-md-3">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fa fa-cash-register"></i> Registrar venta </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Total a pagar</label>
                            <input type="text" class="form-control" id="precio_total_pagar" style="text-align: center; background-color: #cfe6ff;" value="<?php echo '$' . $precio_total ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Método de pago</label>
                            <input type="text" class="form-control" value="<?php echo $metodo_pago?>" id="metodo_pago_pagar" style="text-align: center;" value="" disabled>
                        </div>

                       

                    </div>



                </div>

            </div>
        </div>
    </div>
</div>
</div>

<!-- /.row -->
</div><!-- /.container-fluid -->
</div><!-- /.content -->
</div><!-- /.content-wrapper -->

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


        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    $(function() {
        $("#example2").DataTable({
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ CLIENTES",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de MAX total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ clientes",
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


        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<!-- Modal Agregar nuevo cliente  -->

<div class="modal fade" id="modal-agregar_cliente">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17a2b8; color: white">
                <h4 class="modal-title"> Nuevo de cliente </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/guardar_cliente.php" method="post">

                    <div class="form-group">
                        <label for="">Nombre del Cliente</label>
                        <input type="text" name="nombre_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">DNI </label>
                        <input type="text" name="dni_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Teléfono </label>
                        <input type="text" name="celular_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email </label>
                        <input type="email" name="email_cliente" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block">Guardar Cliente</button>
                    </div>



                </form>

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