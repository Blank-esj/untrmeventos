<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Regalo
            <small>Llena el formulario para crear un Regalo.</small>
        </h1>
    </section>
    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <!-- Main content -->
                <div class="box">
                    <!-- Default box -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Regalo</h3>
                    </div>
                    <form method="post" action="dashboard">
                        <div class="box-body">
                            <div class="row">

                                <!-- Nombre -->
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre </label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
                                </div>

                                <!-- Stock -->
                                <div class="form-group col-md-6">
                                    <label for="stock">Stock </label>
                                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Ingrese el stock">
                                </div>

                            </div>

                        </div> <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="dashboard" value="regalo-crear">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>

                    </form>
                </div> <!-- /.box-body -->
        </div> <!-- /.box -->
        </section> <!-- /.content -->
    </div>
</div> <!-- /.content-wrapper -->