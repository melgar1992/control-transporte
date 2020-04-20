<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Nuevo tipo de contrato <small>-</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-default'>Agregar</button>
              </div>
            </div>
          </div>

          <br>

          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tabla de nombre de contratos</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="table-responsive">
                  <table class="table table-bordered" id="tablaTipoContrato">
                    <thead>
                      <tr>
                        <th>ID Contrato</th>
                        <th>Tipo de Contrato</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      if ($datos->num_rows()) {
                        foreach ($datos->result() as $row) { ?>
                          <tr>
                            <td><?php echo $row->ID_tipoContrato ?></td>
                            <td><?php echo $row->Descripcion ?></td>
                            <td>
                              <div class="text-right">
                                <div class="btn-group">
                                  <button class="btn btn-warning" id="btn-editar"><i class="fas fa-pencil-alt"></i> Editar</button>
                                  <button class="btn btn-danger" id="btn-borrar"><i class="fas fa-trash-alt"></i> Borrar</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                      <?php }
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Formulario contrato</h4>
      </div>
      <form action="" id="formContatos">
        <div class="modal-body">

          <div class="form-group">
            <label for="tipo_contrato">Tipo Contrato</label>
            <input type="text" class="form-control" id="tipoContrato" required='required' name="tipoContrato" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Gerente, conductor, ayudante de conductos, etc.</small>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" id="btn-cerrar" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success pull-right" id="btn-guardar">Guardar</button>
        </div>
      </form>
    </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->