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
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />

          <form method="post" id="nuevo_pago" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CI">CI <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"  list="listCI" id="CI" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
              <!-- Lista de Nombres -->
              <datalist id="listCI">
                  <?php
                  
                  if ($empleados->num_rows()) {
                    foreach ($empleados->result() as $row) { ?>
                      <option value="<?php echo $row->CI ?>"><?php echo $row->Nombres ?>  <?php echo $row->Apellido_p ?></option>
                    <?php }
                }
                ?>
                </datalist>
              
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="nombres" name="nombres" required="required" class="form-control col-md-7 col-xs-12">
              </div>

            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_pago">Fecha de Pago <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                  <input type='date' class="form-control" id="fecha_pago" name="fecha_pago" required="required" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mes_correspondiente">Mes correspondiente <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                  <input type='month' class="form-control" id="mes_correspondiente" name="mes_correspondiente" required="required" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="Descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="Descripcion" id="Descripcion" class="form-control" rows="3"  placeholder="Descripcion" required="required"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="pago" class="control-label col-md-3 col-sm-3 col-xs-12"> Bs <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="pago" class="form-control col-md-7 col-xs-12" type="decimal" name="pago" required="required" placeholder="2000">
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group" id="botones">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button class="btn btn-primary" type="button">Cancelar</button>
                <button class="btn btn-primary" type="reset">Borrar</button>
                <button type="submit" id="tipo" value="<?php echo site_url('/pagoEmpleados/IngresarPagoEmpleado') ?>" class="btn btn-success">Guardar</button>
                <button type='button' data-acction="editar" id="editar" value="<?php echo site_url('') ?>" class="btn btn-warning">Editar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>