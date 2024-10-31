<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/listado_de_productos.php');
include('../app/controllers/categorias/listado_de_categorias.php');
?>

<!-- Contenedor principal -->
<div class="content-wrapper">
    <!-- Encabezado de la página -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo producto</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Contenido principal -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Complete los datos del producto</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="productForm" action="../app/controllers/almacen/create.php" method="post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="codigo">Código:</label>
                                                    <input type="text" class="form-control" id="codigo" name="codigo" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="id_categoria">Categoría:</label>
                                                    <div style="display: flex">
                                                        <select name="id_categoria" id="id_categoria" class="form-control" required>
                                                            <?php foreach($categorias_datos as $categorias_dato) { ?>
                                                                <option value="<?php echo $categorias_dato['id_categoria'] ?>">
                                                                    <?php echo $categorias_dato['nombre_categoria'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        <a href="<?php echo $URL ?>/categorias" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre del producto:</label>
                                                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="usuario">Usuario:</label>
                                                    <input type="text" class="form-control" value="<?php echo $email_session ?>" disabled>
                                                    <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="descripcion">Descripción:</label>
                                                    <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="stock">Stock:</label>
                                                    <input type="number" name="stock" id="stock" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="stock_minimo">Stock mínimo:</label>
                                                    <input type="number" name="stock_minimo" id="stock_minimo" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="stock_maximo">Stock máximo:</label>
                                                    <input type="number" name="stock_maximo" id="stock_maximo" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="precio_compra">Precio compra:</label>
                                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="precio_venta">Precio venta:</label>
                                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="fecha_ingreso">Fecha de ingreso:</label>
                                                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Guardar producto</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
document.getElementById('id_categoria').addEventListener('change', function() {
    var id_categoria = this.value;
    var codigo = 'P' + id_categoria + '-';

    // Obtener el código más alto en la categoría seleccionada
    fetch('../app/controllers/almacen/get_product_max_code.php?id_categoria=' + id_categoria)
        .then(response => response.json())
        .then(data => {
            var max_codigo = data.max_codigo;
            var next_number = 1; // Inicia desde 1 si no hay productos

            if (max_codigo) {
                var match = max_codigo.match(/-(\d+)$/);
                if (match) {
                    next_number = parseInt(match[1]) + 1;
                }
            }

            codigo += next_number.toString().padStart(5, '0');
            document.getElementById('codigo').value = codigo;
        })
        .catch(error => console.error('Error al obtener el código más alto:', error));
});

</script>
