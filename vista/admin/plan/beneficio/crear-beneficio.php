<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Beneficios
            <small>Aquí podrás agregar un nuevo benficio.</small>
        </h1>
    </section>

    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <!-- Main content -->
                <div class="box">
                    <!-- Default box -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Beneficio</h3>
                    </div>
                    <form method="post" action="dashboard">
                        <div class="box-body">

                            <!-- Nombre -->
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre: </label>
                                <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
                            </div>

                        </div>

                        <div class="box-footer">
                            <input type="hidden" name="dashboard" value="beneficio-crear">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>

                    </form>
                </div> <!-- /.box-body -->
            </section> <!-- /.content -->
        </div> <!-- /.box -->
    </div>
</div> <!-- /.content-wrapper -->