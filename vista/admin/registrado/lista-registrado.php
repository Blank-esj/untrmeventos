<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Registrados
      <small>Aquí podrás editar y eliminar a los Registrados. </small>
    </h1>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Administra a los registrados</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Nombre de Registrado</th>
                  <th>E-mail</th>
                  <th>Fecha de registro</th>
                  <th>Artículos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT registrado.*, regalo.nombre_regalo FROM registrado ";
                  $sql .= " JOIN regalo ";
                  $sql .= " ON registrado.regalo = regalo.id_regalo ";
                  $resultado = $conn->query($sql);
                } catch (Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                $numero = 1;
                if ($resultado != false) {

                  while ($registrado = $resultado->fetch_assoc()) {
                ?>
                    <tr>
                      <td> <?php echo $numero; ?> </td>
                      <td> <?php echo $registrado['nombre_registrado'] . " " . $registrado['apellidopa_registrado'] . " " . $registrado['apellidoma_registrado'];
                            $pagado = $registrado['pagado'];
                            if ($pagado) {
                              echo '<span class="badge bg-green"> Pagado </span>';
                            } else {
                              echo '<span class="badge bg-red"> No pagado </span>';
                            }
                            ?> </td>
                      <td> <?php echo $registrado['email_registrado']; ?> </td>
                      <td> <?php echo $registrado['fecha_registro']; ?> </td>
                      <td> <?php $articulos = json_decode($registrado['pases_articulos'], true);
                            $arreglo_articulos = array(
                              'un_dia' => '- Pase 1 día',
                              'pase_2dias' => '- Pase 2 días',
                              'pase_completo' => '- Pase Completo',
                              'camisas' => '- Camisas',
                              'etiquetas' => '- Etiquetas'
                            );
                            /**
                             * Recibe el json, le adjunta un llave, y lo asigna a un variable 
                             * verifica si el array existe, si la llave exite en el array y lo  muestra
                             */
                            foreach ($articulos as $llave => $articulo) {
                              if (is_array($articulo) && array_key_exists('cantidad', $articulo)) {
                                echo $articulo['cantidad'] . " " . $arreglo_articulos[$llave] . "<br>";
                              } else {
                                echo $articulo . " " . $arreglo_articulos[$llave] . "<br>";
                              }
                            }

                            ?> </td>
                      <td> <?php $eventos_resultado = $registrado['taller_registrado'];
                            $talleres = json_decode($eventos_resultado, true);
                            $talleres = implode("', '", $talleres['eventos']);
                            $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM evento WHERE clave IN ('$talleres') OR id_evento IN ('$talleres') ";
                            $resultado_talleres = $conn->query($sql_talleres);
                            while ($eventos = $resultado_talleres->fetch_assoc()) {
                              echo " -" . $eventos['nombre_evento'] . " <br> " . " " . $eventos['fecha_evento'] . "   " . $eventos['hora_evento'] . "<br>";
                            }
                            ?> </td>
                      <td> <?php echo $registrado['nombre_regalo']; ?> </td>
                      <td> S/ <?php echo (float) $registrado['total_pagado']; ?> </td>
                      <td>
                        <a href="editar-registrado.php?id=<?php echo $registrado['id_registrado'] ?>" class="btn bg-orange btn-flat margin">
                          <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a href="#" data-id="<?php echo $registrado['id_registrado']; ?>" data-tipo="registrado" class="btn bg-maroon btn-flat margin borrar_registro">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php
                    $numero++;
                  }
                } else { ?>
                  <h1>No hay ningún registrado</h1>
                <?php }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nº</th>
                  <th>Nombre de Registrado</th>
                  <th>E-mail</th>
                  <th>Fecha de registro</th>
                  <th>Artículos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->