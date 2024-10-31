<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/listado_de_productos.php');
include('../app/controllers/proveedores/listado_de_proveedores.php');
include('../app/controllers/compras/cargar_compra.php');


?>

<!-- Contenedor principal -->
<div class="content-wrapper">
    <!-- Encabezado de la página -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualización de la compra N° <?php echo $nro_compra ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Contenido principal -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Complete los datos del producto</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div style="display: flex">
                                        <h5>Datos del producto</h5>
                                        <div style="width: 20px"></div>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
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
                                                                            <center>Precio compra</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Precio venta</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Fecha compra</center>
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

                                                                                        var id_producto = "<?php echo $productos_dato['id_producto'] ?>"
                                                                                        $('#id_producto').val(id_producto);

                                                                                        var codigo = "<?php echo $productos_dato['codigo'] ?>"
                                                                                        $('#codigo').val(codigo);

                                                                                        var categoria = "<?php echo $productos_dato['categoria'] ?>"
                                                                                        $('#categoria').val(categoria);

                                                                                        var nombre = "<?php echo $productos_dato['nombre'] ?>"
                                                                                        $('#nombre_producto').val(nombre);

                                                                                        var email = "<?php echo $productos_dato['email'] ?>"
                                                                                        $('#usuario_producto').val(email);

                                                                                        var descripcion = "<?php echo $productos_dato['descripcion'] ?>"
                                                                                        $('#descripcion_producto').val(descripcion);

                                                                                        var stock = "<?php echo $productos_dato['stock'] ?>"
                                                                                        $('#stock').val(stock);
                                                                                        $('#stock_actual').val(stock);

                                                                                        var stock_minimo = "<?php echo $productos_dato['stock_minimo'] ?>"
                                                                                        $('#stock_minimo').val(stock_minimo);

                                                                                        var stock_maximo = "<?php echo $productos_dato['stock_maximo'] ?>"
                                                                                        $('#stock_maximo').val(stock_maximo);

                                                                                        var precio_compra = "<?php echo $productos_dato['precio_compra'] ?>"
                                                                                        $('#precio_compra').val(stock_maximo);

                                                                                        var precio_venta = "<?php echo $productos_dato['precio_venta'] ?>"
                                                                                        $('#precio_venta').val(precio_venta);

                                                                                        var fecha_ingreso = "<?php echo $productos_dato['fecha_ingreso'] ?>"
                                                                                        $('#fecha_ingreso').val(fecha_ingreso);

                                                                                        $('#modal-buscar_producto').modal('toggle');

                                                                                    })
                                                                                </script>
                                                                            </td>
                                                                            <td><?php echo $productos_dato['codigo'] ?></td>
                                                                            <td><?php echo $productos_dato['nombre_categoria'] ?></td>
                                                                            <td><?php echo $productos_dato['nombre'] ?></td>
                                                                            <td><?php echo $productos_dato['descripcion'] ?></td>
                                                                            <td><?php echo $productos_dato['stock'] ?></td>
                                                                            <td><?php echo '$' . $productos_dato['precio_compra'] ?></td>
                                                                            <td><?php echo '$' . $productos_dato['precio_venta'] ?></td>
                                                                            <td><?php echo $productos_dato['fecha_ingreso'] ?></td>

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

                                                    <div>

                                                    </div>
                                                    <div id="repuesta"></div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </div>


                                    <hr>
                                    <div class="row" style="font-size: 12px">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text"  value="<?= $id_producto_tabla?>" class="form-control" id="id_producto"  hidden>
                                                        <label for="">Código:</label>
                                                        <input type="text" value="<?= $codigo ?>" class="form-control" id="codigo" disabled>

                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Categoría:</label>
                                                        <input type="text" value="<?= $categoria ?>"  class="form-control" id="categoria" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Nombre del producto:</label>
                                                        <input type="text" value="<?= $nombre_producto ?>" name="nombre" class="form-control" id="nombre_producto" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Usuario:</label>
                                                        <input type="text"  value="<?= $usuario_producto?>" class="form-control" id="usuario_producto" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">Descripción:</label>
                                                        <textarea name="descripcion" id="descripcion_producto" cols="30" rows="2" class="form-control" disabled> <?= $descripcion?></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock:</label>
                                                        <input type="number"  value="<?= $stock ?>" name="stock" id="stock" class="form-control" style="background-color: #cfe6ff" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock mínimo:</label>
                                                        <input type="number" value="<?= $stock_minimo ?>"  name="stock_minimo" id="stock_minimo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock máximo:</label>
                                                        <input type="number" value="<?= $stock_maximo ?>"  name="stock_maximo" id="stock_maximo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio compra:</label>
                                                        <input type="number"  value="<?= $precio_compra_producto ?>" name="precio_compra" id="precio_compra" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio venta:</label>
                                                        <input type="number" value="<?= $precio_venta_producto ?>" name="precio_venta" id="precio_venta" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha de ingreso:</label>
                                                        <input type="date"  value="<?= $fecha_ingreso ?>" name="fecha_ingreso" id="fecha_ingreso" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <!-- eleccion provedor -->

                                            <div style="display: flex">
                                                <h5>Datos del proveedor</h5>
                                                <div style="width: 20px"></div>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#modal-buscar_proveedor">
                                                    <i class="fa fa-search"></i> Buscar proveedor
                                                </button>
                                                <!--- Modal para buscar proveedor--->

                                                <div class="modal fade" id="modal-buscar_proveedor">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #007bff; color: white">
                                                                <h4 class="modal-title">Busqueda del proveedor </h4>
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
                                                                                    <td>
                                                                                        <button class="btn btn-primary btn-sm" id="btn_seleccionar_proveedor<?php echo $id_proveedor ?>">
                                                                                            Seleccionar
                                                                                        </button>
                                                                                    </td>
                                                                                    <script>
                                                                                        $('#btn_seleccionar_proveedor<?php echo $id_proveedor ?>').click(function() {

                                                                                            var id_proveedor = '<?php echo $id_proveedor ?>';
                                                                                            $('#id_proveedor').val(id_proveedor);

                                                                                            var nombre_proveedor = '<?php echo $nombre_proveedor ?>';
                                                                                            $('#nombre_proveedor').val(nombre_proveedor);

                                                                                            var telefono_proveedor = '<?php echo $proveedores_dato['telefono'] ?>';
                                                                                            $('#telefono').val(telefono_proveedor);

                                                                                            var email_proveedor = '<?php echo $proveedores_dato['email'] ?>';
                                                                                            $('#email_proveedor').val(email_proveedor);

                                                                                            var cuit_proveedor = '<?php echo $proveedores_dato['cuit'] ?>';
                                                                                            $('#cuit').val(cuit_proveedor);

                                                                                            var direccion_proveedor = '<?php echo $proveedores_dato['direccion'] ?>';
                                                                                            $('#direccion').val(direccion_proveedor);

                                                                                            $('#modal-buscar_proveedor').modal('toggle');
                                                                                        });
                                                                                    </script>
                                                                                    <td><?php echo $proveedores_dato['nombre_proveedor'] ?></td>
                                                                                    <td><?php echo $proveedores_dato['telefono'] ?></td>
                                                                                    <td><?php echo $proveedores_dato['email'] ?></td>
                                                                                    <td><?php echo $proveedores_dato['direccion'] ?></td>
                                                                                    <td><?php echo $proveedores_dato['cuit'] ?></td>

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

                                                            <div>

                                                            </div>
                                                            <div id="repuesta"></div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->


                                            </div>

                                            <hr>


                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= $id_proveedor_tabla?>" id="id_proveedor" hidden>
                                                        <label for="">Nombre del proveedor</label>
                                                        <input type="text" value="<?= $nombre_proveedor_compra ?>" id="nombre_proveedor" class="form-control" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Teléfono</label>
                                                        <input type="number" value="<?= $telefono_proveedor ?>" id="telefono" class="form-control" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <label for="">CUIT</label>
                                                        <input type="number" value="<?= $cuit ?>" id="cuit" class="form-control" disabled>

                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Dirección</label>
                                                        <input type="text " value="<?= $direccion_proveedor ?>" id="direccion" class="form-control" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email"  value="<?= $email_proveedor ?>" id="email_proveedor" class="form-control" disabled>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>

                </div>

                <!-- seccion detalle compra  -->

                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Detalle de la compra</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                
                                                <label for="">N° compra :</label>
                                                <input type="text" value="<?php echo $nro_compra ?>" style="text-align: center" class="form-control" disabled>
                                                <input type="text" value="<?php echo $nro_compra ?>" id="nro_compra" hidden>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Fecha compra :</label>
                                                <input type="date" value="<?php echo $fecha_compra?>" class="form-control" id="fecha_compra">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Comprobante:</label>
                                                <input type="text"  value="<?php echo $comprobante?>" class="form-control" id="comprobante">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Precio Compra:</label>
                                                <input type="number" value="<?= $precio_compra?>"  class="form-control" id="precio_compra_detalle">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""> Stock ACTUAL:</label>
                                                <input type="text" value="<?= $stock=$stock-$cantidad?>" id="stock_actual" class="form-control" style="background-color: #cfe6ff" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""> Stock TOTAL:</label>
                                                <input type="text" id="stock_total" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Cantidad producto compra:</label>
                                                <input type="number" value="<?= $cantidad?>" id="cantidad_compra" style="text-align: center" class="form-control">
                                            </div>
                                            <script>
                                                $('#cantidad_compra').keyup(function() {
                                                    sumaCantidades();
                                                })
                                                sumaCantidades();
                                                function sumaCantidades(){
                                                    var stock_actual = $('#stock_actual').val();
                                                    var stock_compra = $('#cantidad_compra').val();

                                                    var total = parseInt(stock_actual) + parseInt(stock_compra);
                                                    $('#stock_total').val(total);
                                                }
                                            </script>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Usuario:</label>
                                                <input type="text" value="<?php echo $usuario_compra ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success btn-block" id="btn_actualizar_compra">Actualizar compra</button>
                                        </div>
                                    </div>
                                    <script>
                                        $('#btn_actualizar_compra').click(function() {
                                            var id_compra = <?php echo $id_compra ?>;
                                            var id_producto = $('#id_producto').val();
                                            var nro_compra = $('#nro_compra').val();
                                            var fecha_compra = $('#fecha_compra').val();
                                            var id_proveedor = $('#id_proveedor').val();
                                            var comprobante = $('#comprobante').val();
                                            var id_usuario = <?php echo $id_usuario_sesion ?>;
                                            var precio_compra= $('#precio_compra_detalle').val();
                                            var cantidad_compra = $('#cantidad_compra').val();
                                            var stock_total = $('#stock_total').val();
                                            var texto = "Debes llenar todos los  campos";

                                            if (id_producto == "") {
                                                $('#id_producto').focus();
                                                alert(texto);

                                            } else if (fecha_compra == "") {
                                                $('#fecha_compra').focus();
                                                alert(texto);

                                            } else if (comprobante == "") {
                                                $('#comprobante').focus();
                                                alert(texto);

                                            } else if (precio_compra == "") {
                                                $('#precio_compra_detalle').focus();
                                                alert(texto);

                                            } else if (cantidad_compra == "") {
                                                $('#cantidad_compra').focus();
                                                alert(texto);

                                            } else {
                                                var url = "../app/controllers/compras/update.php";
                                                $.get(url, {
                                                    id_compra:id_compra,
                                                    id_producto:id_producto,
                                                    nro_compra:nro_compra,
                                                    fecha_compra:fecha_compra,
                                                    id_proveedor:id_proveedor,
                                                    id_usuario:id_usuario,
                                                    precio_compra:precio_compra,
                                                    cantidad_compra:cantidad_compra,
                                                    comprobante:comprobante,
                                                    stock_total: stock_total,
                                                    
                                                   

                                                }, function(datos) {
                                                    $('#respuesta').html(datos);
                                                })
                                            }
                                        })
                                    </script>

                                </div>

                            </div>

                        </div>

                        <div id="respuesta"></div>

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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de MAX total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ proveedores",
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