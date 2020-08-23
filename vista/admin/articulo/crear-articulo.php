<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Artículos
            <small>Aquí podrás agregar un nuevo artículo.</small>
        </h1>
    </section>
    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <!-- Main content -->
                <div class="box">
                    <!-- Default box -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Artículo</h3>
                    </div>
                    <!-- form start -->
                    <form method="post" action="dashboard" enctype="multipart/form-data">
                        <div class="box-body">

                            <!-- Nombre -->
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre: </label>
                                <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
                            </div>

                            <!-- url_imagen / imagen_articulo -->
                            <div class="form-group col-md-6">
                                <label for="imagen_articulo">Imagen:</label>
                                <input type="file" id="imagen_articulo" name="archivo_imagen">
                                <h6 class="help-block">Agregar la imagen del artículo aquí.</h6>
                            </div>

                            <!-- Precio -->
                            <div class="form-group col-md-6">
                                <label for="precio">Precio: </label>
                                <input required type="number" class="form-control" name="precio" id="precio" placeholder="Ingrese el precio">
                            </div>

                            <!-- Stock -->
                            <div class="form-group col-md-6">
                                <label for="stock">Stock: </label>
                                <input required type="number" class="form-control" name="stock" id="stock" placeholder="Ingrese el stock">
                            </div>

                            <!-- Descripción -->
                            <div class="form-group col-md-12">
                                <label for="btextarea">Descripción: </label>
                                <textarea class="form-control" id="btextarea" name="descripcion" placeholder="Ingrese una descripción"></textarea>
                            </div>

                        </div> <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="dashboard" value="articulo-crear">Agregar</button>
                        </div>
                    </form>
                </div> <!-- /.box -->
            </section> <!-- /.content -->
        </div>
    </div>
</div> <!-- /.content-wrapper -->