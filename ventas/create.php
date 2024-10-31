<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/ventas/listado_de_ventas.php');
include('../app/controllers/almacen/listado_de_productos.php');
include('../app/controllers/clientes/listado_de_clientes.php');

?>

<!-- Contenedor principal -->
<div class="content-wrapper">
    <!-- Encabezado de la página -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Ventas</h1>
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
                            <?php
                            $contador_de_ventas = 0;
                            foreach ($ventas_datos as $ventas_dato) {
                                $contador_de_ventas = $contador_de_ventas + 1;
                            }
                            ?>
                            <h3 class="card-title"> <i class="fa fa-shopping-bag"></i> Detalle de venta N° <input type="text" value="<?php echo $contador_de_ventas + 1 ?>" style="text-align: center" disabled></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <i class="fa fa-shopping-cart"></i>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-buscar_producto">
                                <i class="fa fa-search"></i> Buscar producto
                            </button>
                            <!--- Modal para buscar producto--->

                            <div class="modal fade" id="modal-buscar_producto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #007bff; color: white">
                                            <h4 class="modal-title">Busqueda del producto </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table id="example1" class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center>N°</center>
                                                            </th>
                                                            <th>
                                                                <center>Seleccionar</center>
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
                                                                <center>Precio venta</center>
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
                                                                <td>
                                                                    <button class="btn btn-primary btn-sm" id="btn_seleccionar<?php echo $id_producto ?>">
                                                                        Seleccionar
                                                                    </button>
                                                                    <script>
                                                                        $('#btn_seleccionar<?php echo $id_producto ?>').click(function() {

                                                                            var id_producto = "<?php echo  $id_producto ?>"
                                                                            $('#id_producto').val(id_producto);
                                                                            var producto = "<?php echo $productos_dato['nombre'] ?>"
                                                                            $('#producto').val(producto);
                                                                            var descripcion = "<?php echo $productos_dato['descripcion'] ?>"
                                                                            $('#descripcion').val(descripcion);
                                                                            var precio_venta = "<?php echo $productos_dato['precio_venta'] ?>"
                                                                            $('#precio_venta').val(precio_venta);
                                                                            $('#cantidad').focus();






                                                                        })
                                                                    </script>
                                                                </td>
                                                                <td><?php echo $productos_dato['codigo'] ?></td>
                                                                <td><?php echo $productos_dato['nombre_categoria'] ?></td>
                                                                <td><?php echo $productos_dato['nombre'] ?></td>
                                                                <td><?php echo $productos_dato['descripcion'] ?></td>
                                                                <td><?php echo $productos_dato['stock'] ?></td>
                                                                <td><?php echo '$' . $productos_dato['precio_venta'] ?></td>


                                                            </tr>
                                                        <?php
                                                        }

                                                        ?>
                                                    </tbody>

                                                    <tfoot>

                                                    </tfoot>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-goup">
                                                            <input type="text" id="id_producto" hidden>
                                                            <label for="">Producto</label>
                                                            <input type="text" id="producto" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-goup">
                                                            <label for="">Descripcion</label>
                                                            <input type="text" id="descripcion" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-goup">
                                                            <label for="">Cantidad</label>
                                                            <input type="text" id="cantidad" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-goup">
                                                            <label for="">Precio unitario</label>
                                                            <input type="text" id="precio_venta" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>





                                            </div>
                                            <button class="btn btn-primary" id="btn_cargar_carrito" style="float:right">Cargar</button>
                                            <script>
                                                $('#btn_cargar_carrito').click(function() {
                                                    var nro_venta = '<?php echo $contador_de_ventas + 1 ?>'
                                                    var id_producto = $('#id_producto').val();
                                                    var cantidad = $('#cantidad').val();

                                                    if (id_producto == "") {
                                                        alert("Debe Seleccionar un producto");
                                                    } else if (cantidad == "") {
                                                        alert("Debe de llenar la cantidad del producto");
                                                    } else {
                                                        var url = "../app/controllers/ventas/registrar_carrito.php";
                                                        $.get(url, {
                                                            nro_venta: nro_venta,
                                                            id_producto: id_producto,
                                                            cantidad: cantidad

                                                        }, function(datos) {

                                                            $('#modal-buscar_producto').modal('hide');

                                                            window.location.href = "<?php echo $URL; ?>/ventas/create.php";

                                                            $('#respuesta').html(datos);
                                                        })


                                                    }

                                                });
                                            </script>
                                            <br> <br>

                                        </div>





                                    </div>

                                    <div>

                                    </div>
                                    <div id="repuesta"></div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->


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
                                        <th style="background-color: #e7e7e7; text-align:center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_de_carrito = 0;
                                    $cantidad_total = 0;
                                    $precio_unitario_total = 0;
                                    $precio_total = 0;
                                    $nro_venta = $contador_de_ventas + 1;

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
                                            <td>
                                                <center>
                                                    <form action="../app/controllers/ventas/borrar_carrito.php" method="post">
                                                        <input type="text" name="id_carrito" value="<?php echo $id_carrito ?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </center>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                    <tr>
                                        <td colspan="5" style=" text-align:right"> Descuento (%)</td>
                                        <td>
                                            <input type="number" id="descuento" name="descuento" placeholder="Ingrese % de descuento" oninput="aplicarDescuento()">
                                        </td>
                                    </tr>

                                    <script>
                                        function aplicarDescuento() {

                                            var precioTotal = <?php echo $precio_total; ?>;
                                            var descuento = document.getElementById('descuento').value;
                                            if (descuento >= 0 && descuento <= 100) {
                                                var descuentoAplicado = (precioTotal * descuento) / 100;
                                                var precioFinal = precioTotal - descuentoAplicado;


                                                document.getElementById('precio_total_final').innerText = precioFinal.toFixed(2);
                                                document.getElementById('precio_total_pagar').value = '$' + precioFinal.toFixed(2);

                                            }
                                        }
                                    </script>




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
                                            <select id="metodo_pago" name="metodo_pago" class="form-control" onchange="actualizarMetodoDePago()">
                                                <option value="" disabled selected>Elegir método de pago</option>
                                                <option value="efectivo">Efectivo</option>
                                                <option value="tarjeta credito">Tarjeta de Crédito</option>
                                                <option value="tarjeta debito">Tarjeta de Débito</option>
                                                <option value="transferencia">Transferencia Bancaria</option>
                                                <option value="billetera virtual">Billetera Virtual</option>
                                            </select>
                                        </td>
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
                    <div class="card-body">

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-buscar_cliente">
                            <i class="fa fa-search"></i> Buscar Cliente
                        </button>
                        <!--- Modal para buscar datos clientes registrados--->

                        <div class="modal fade" id="modal-buscar_cliente">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #007bff; color: white">
                                        <h4 class="modal-title">Busqueda de cliente </h4>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal-agregar_cliente">
                                            <i class="fa fa-user-plus"></i> Agregar nuevo Cliente
                                        </button>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table table-responsive">
                                            <table id="example2" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <center>N°</center>
                                                        </th>
                                                        <th>
                                                            <center>Seleccionar</center>
                                                        </th>
                                                        <th>
                                                            <center>Nombre del cliente</center>
                                                        </th>
                                                        <th>
                                                            <center>DNI</center>
                                                        </th>
                                                        <th>
                                                            <center>Celular</center>
                                                        </th>
                                                        <th>
                                                            <center>Email</center>
                                                        </th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $contador_de_clientes = 0;
                                                    foreach ($clientes_datos as $clientes_dato) {
                                                        $id_cliente = $clientes_dato['id_cliente'];
                                                        $contador_de_clientes = $contador_de_clientes + 1;
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <center><?php echo $contador_de_clientes ?></center>
                                                            </td>
                                                            <td>
                                                                <center><button id="btn_pasar_cliente<?php echo $id_cliente ?>" class="btn btn-info">Seleccionar</button>
                                                                    <script>
                                                                        $('#btn_pasar_cliente<?php echo $id_cliente ?>').click(function() {
                                                                            var id_cliente = '<?php echo $clientes_dato['id_cliente'] ?>';
                                                                            $('#id_cliente').val(id_cliente);
                                                                            var nombre_cliente = '<?php echo $clientes_dato['nombre_cliente'] ?>';
                                                                            $('#nombre_cliente').val(nombre_cliente);
                                                                            var dni_cliente = '<?php echo $clientes_dato['dni_cliente'] ?>';
                                                                            $('#dni_cliente').val(dni_cliente);
                                                                            var celular_cliente = '<?php echo $clientes_dato['celular_cliente'] ?>';
                                                                            $('#celular_cliente').val(celular_cliente);
                                                                            var email_cliente = '<?php echo $clientes_dato['email_cliente'] ?>';
                                                                            $('#email_cliente').val(email_cliente);

                                                                            $('#modal-buscar_cliente').modal('toggle');

                                                                        })
                                                                    </script>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $clientes_dato['nombre_cliente'] ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $clientes_dato['dni_cliente'] ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $clientes_dato['celular_cliente'] ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?php echo $clientes_dato['email_cliente'] ?></center>
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





                                </div>

                                <div>

                                </div>
                                <div id="repuesta"></div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->

                        <!-- /.modal -->

                        <br><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" id="id_cliente" hidden>
                                    <label for="">Nombre del cliente</label>
                                    <input type="text" class="form-control" id="nombre_cliente" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">DNI </label>
                                    <input type="text" class="form-control" id="dni_cliente" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Teléfono </label>
                                    <input type="text" class="form-control" id="celular_cliente" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" id="email_cliente" disabled>
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
                            <input type="text" class="form-control" id="metodo_pago_pagar" style="text-align: center;" value="" disabled>
                        </div>

                        <script>
                            function actualizarMetodoDePago() {

                                var metodoSeleccionado = document.getElementById('metodo_pago').value;

                                document.getElementById('metodo_pago_pagar').value = metodoSeleccionado;
                            }
                        </script>

                        <div class="form-group">
                            <button id="btn_guardar_venta" class="btn btn-primary btn-block">Guardar Venta</button>
                        </div>

                        <script>
                            $('#btn_guardar_venta').click(function() {


                                var nro_venta = '<?php echo $contador_de_ventas + 1 ?>';
                                var id_cliente = $('#id_cliente').val();
                                var total_pagado = $('#precio_total_pagar').val().replace('$', '').trim();
                                var metodo_pago = $('#metodo_pago_pagar').val();

                                if (id_cliente == "") {
                                    alert("Debe llenar los datos del cliente");
                                } else if (total_pagado == "" || parseFloat(total_pagado) === 0) {
                                    alert("Debe cargar productos en la venta");
                                } else if (metodo_pago == "") {
                                    alert("Debe seleccionar un método de pago");
                                } else {

                                    actualizar_stock();
                                    guardar_venta();


                                }


                                function actualizar_stock() {
                                    var i = 1;
                                    var n = <?php echo $contador_de_carrito ?>;

                                    for (var i = 1; i <= n; i++) {
                                        var a = '#stock_inventario' + i;
                                        var stock_inventario = $(a).val();

                                        var b = '#cantidad_carrito' + i;
                                        var cantidad_carrito = $(b).html();

                                        var c = '#id_producto_carrito' + i;
                                        var id_producto = $(c).val();


                                        var stock_calculado = parseFloat(stock_inventario - cantidad_carrito);

                                        //alert( id_producto + " : "+ stock_inventario +" - "+ cantidad_carrito +" = "+ stock_calculado)
                                        var url2 = "../app/controllers/ventas/actualizar_stock.php";
                                        $.get(url2, {
                                            id_producto: id_producto,
                                            stock_calculado: stock_calculado,


                                        }, function(datos) {})

                                    }
                                }


                                function guardar_venta() {
                                    var url = "../app/controllers/ventas/registro_ventas.php";
                                    $.get(url, {
                                        nro_venta: nro_venta,
                                        id_cliente: id_cliente,
                                        total_pagado: total_pagado,
                                        metodo_pago: metodo_pago,

                                    }, function(datos) {

                                        window.location.href = "<?php echo $URL; ?>/ventas/index.php";
                                        $('#respuesta').html(datos);
                                    })

                                }



                            })
                        </script>




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