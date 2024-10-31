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
                    <h1 class="m-0">Compra N° <?php echo $nro_compra ?></h1>
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
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">¿Esta seguro de eliminar la compra ?</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <div style="display: flex">
                                        <h5>Datos del producto</h5>
                                        <div style="width: 20px"></div>
                                    </div>

                                    <hr>
                                    <div class="row" style="font-size: 12px">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= $id_producto_tabla ?>" class="form-control" id="id_producto" hidden>
                                                        <label for="">Código:</label>
                                                        <input type="text" value="<?php echo $codigo ?>" class="form-control" id="codigo" disabled>

                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Categoría:</label>
                                                        <input type="text" value="<?php echo $categoria ?>" class="form-control" id="categoria" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Nombre del producto:</label>
                                                        <input type="text" name="nombre" value="<?php echo $nombre_producto ?> " class="form-control" id="nombre_producto" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Usuario:</label>
                                                        <input type="text" value="<?php echo $usuario_producto ?> " class="form-control" id="usuario_producto" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">Descripción:</label>
                                                        <textarea name="descripcion" id="descripcion_producto" cols="30" rows="2" class="form-control" disabled> <?php echo $descripcion ?> </textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock:</label>
                                                        <input type="number" value="<?php echo $stock ?>" name="stock" id="stock" class="form-control" style="background-color: #cfe6ff" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock mínimo:</label>
                                                        <input type="number" value="<?php echo $stock_minimo ?>" name="stock_minimo" id="stock_minimo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock máximo:</label>
                                                        <input type="number" value="<?php echo $stock_maximo ?>" name="stock_maximo" id="stock_maximo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio compra:</label>
                                                        <input type="text" value="<?php echo '$' . $precio_compra_producto ?>" id="precio_compra" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio venta:</label>
                                                        <input type="text" value="<?php echo '$' . $precio_venta_producto ?>" id="precio_venta" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha de ingreso:</label>
                                                        <input type="date" value="<?php echo $fecha_ingreso ?>" name="fecha_ingreso" id="fecha_ingreso" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <!-- eleccion provedor -->

                                            <div style="display: flex">
                                                <h5>Datos del proveedor</h5>
                                                <div style="width: 20px"></div>
                                            </div>

                                            <hr>


                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_proveedor" hidden>
                                                        <label for="">Nombre del proveedor</label>
                                                        <input type="text" value="<?php echo $nombre_proveedor ?>" id="nombre_proveedor" class="form-control" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Teléfono</label>
                                                        <input type="number" value="<?php echo $telefono_proveedor ?>" id="telefono" class="form-control" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <label for="">CUIT</label>
                                                        <input type="number" value="<?php echo $cuit ?>" id="cuit" class="form-control" disabled>

                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Dirección</label>
                                                        <input type="text" value="<?php echo $direccion_proveedor ?>" id="direccion" class="form-control" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" value="<?php echo $email_proveedor ?>" id="email_proveedor" class="form-control" disabled>

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
                            <div class="card card-outline card-danger">
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

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Fecha compra :</label>
                                                <input type="date" value="<?php echo $fecha_compra ?>" class="form-control" id="fecha_compra" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Comprobante:</label>
                                                <input type="text" value="<?php echo $comprobante ?>" class="form-control" id="comprobante" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Precio Compra:</label>
                                                <input type="text" value="<?php echo '$' . $precio_compra ?>" class="form-control" id="precio_compra_detalle" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""> Cantidad producto compra:</label>
                                                <input type="text" value="<?php echo $cantidad ?>" id="cantidad_compra" style="text-align: center" class="form-control" disabled>
                                            </div>

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
                                            <button class="btn btn-danger btn-block" id="btn_eliminar"><i class="fa fa-trash"></i>Eliminar</button>
                                        </div>
                                    </div>

                                    <script>
                                        $('#btn_eliminar').click(function() {
                                            var id_compra = ' <?php echo  $id_compra_get; ?> ';
                                            var id_producto = $('#id_producto').val();
                                            var cantidad_compra = ' <?= $cantidad  ?> ';
                                            var stock_actual = ' <?= $stock ?> ';

                                            Swal.fire({
                                                title: '¿Está seguro de eliminar la compra?',
                                                icon: 'question',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Si deseo eliminar'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    Swal.fire(
                                                        eliminar(),
                                                        'Compra eliminada',
                                                        'success'

                                                    )
                                                }
                                            });

                                            function eliminar() {
                                                var url = "../app/controllers/compras/delete.php";
                                                $.get(url, {
                                                    id_compra: id_compra,
                                                    id_producto: id_producto,
                                                    cantidad_compra: cantidad_compra,
                                                    stock_actual: stock_actual
                                                }, function(datos) {
                                                    $('#respuesta').html(datos);
                                                });
                                            }
                                        });
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