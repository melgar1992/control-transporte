<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Nuevo pago Empleado <small>-</small></h2>
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

          <form method="post" 
          id = "<?php if ($Accion_pagina == 'NuevoPago') {
            echo 'nuevo_pago';
          } else {
            echo 'EditarPago';
          }
          ?>"
         autocomplete="off" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CI">CI <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <?php if ($Accion_pagina == 'NuevoPago') { ?>
                <input type="text"  list="listCI" id="CI" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
              <!-- Lista de Nombres -->
              <datalist id="listCI">
                  <?php
                  
                  if ($empleados->num_rows()) {
                    foreach ($empleados->result() as $row) { ?>
                      <option value="<?php echo $row->CI ?>"><?php echo $row->Nombres ?>  <?php echo $row->Apellido_p ?></option>
                    <?php }
                }
               }
               else {?>
                <input type="text" disabled id="disabledInput" placeholder="<?php  echo $datos->CI ?>" class="form-control col-md-7 col-xs-12">
                
                <?php
               }
               ?>
                </datalist>
              
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <?php if ($Accion_pagina == 'NuevoPago') { ?>
                <input type="text" id="nombres" name="nombres" required="required" class="form-control col-md-7 col-xs-12">
                <?php 
              }
              else {?>
                <input type="text" disabled id="disabledInput" placeholder="<?php  echo $datos->nombres ?>" class="form-control col-md-7 col-xs-12">
                <?php  
              }
                ?>
              </div>
              
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_pago">Fecha de Pago <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                <?php if ($Accion_pagina == 'NuevoPago') { ?>
                  <input type='date' class="form-control" id="fecha_pago" name="fecha_pago" required="required" />
                  <?php 
              }
              else {?>
                <input type='date' class="form-control" id="fecha_pago" name="fecha_pago" required="required" value="<?php echo $datos->Fecha; ?>" />
              <?php  
              }
                ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mes_correspondiente">Mes correspondiente <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                <?php if ($Accion_pagina == 'NuevoPago') { ?>
                  <input type='month' class="form-control" id="mes_correspondiente" name="mes_correspondiente" required="required" />
                  <?php 
              }
              else {?>
                 <input type='month' class="form-control" id="mes_correspondiente" name="mes_correspondiente" value="<?php echo $datos->MesCorrespondiente; ?>"  required="required" />
                 <?php  
              }
                ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="Descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <?php if ($Accion_pagina == 'NuevoPago') { ?>
                <textarea name="Descripcion" id="Descripcion" class="form-control" rows="3"  placeholder="Descripcion" required="required"></textarea>
                <?php 
              }
              else {?>
                <textarea name="Descripcion" id="Descripcion" class="form-control" rows="3"   placeholder="Descripcion" required="required"><?php echo $datos->Descripcion ?></textarea>
             
              <?php  
              }
                ?>
              </div>
            </div>
            <div class="form-group">
              <label for="pago" class="control-label col-md-3 col-sm-3 col-xs-12"> Bs <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <?php if ($Accion_pagina == 'NuevoPago') { ?>
                <input id="pago" class="form-control col-md-7 col-xs-12" type="decimal" name="pago" required="required" placeholder="2000">
                <?php 
              }
              else {?>

                <input id="pago" class="form-control col-md-7 col-xs-12" type="decimal" name="pago" value="<?php echo $datos->Monto ?>" required="required" placeholder="2000">

              <?php  
              }
                ?>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group" id="botones">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                
              <a class="btn btn-primary"
                                  <?php  if ($Accion_pagina == 'EditarPago'){ 
                                           echo 'href = "'.site_url("/pagoEmpleados/pagoEmpleado").'"';
                                          }
                                  ?> 
                                  type="button"> <?php  if ($Accion_pagina == 'EditarPago'){ 
                                                                      echo "Volver";
                                                                  }
                                                                  else {
                                                                    echo "Cancelar";
                                                                  } 
                                                    ?>
                          </a> 
                <button class="btn btn-primary" type="reset">Borrar</button>
                <button type="submit" 
                                  id="tipo" 
                                  <?php if($Accion_pagina == 'EditarPago'){
                                    echo 'id_data = "'.$datos->ID_pago.'"';
                                  } ?>
                                  value="<?php if ($Accion_pagina == 'EditarPago'){ 
                                                  echo site_url('/pagoEmpleados/editar_pago_empleado');
                                                } else {
                                                  echo site_url('/pagoEmpleados/IngresarPagoEmpleado');
                                                  } ?>" 
                                  class="btn btn-success"> <?php  if ($Accion_pagina == 'EditarPago'){ 
                                                                      echo "Editar";
                                                                  }
                                                                  else {
                                                                    echo "Guardar";
                                                                  } 
                                                              ?>
                          </button>
              </div>
            </div>
          </form>
        </div>

        <div class="x_panel">
              <div class="x_title">
                <h2>Tabla de Pagos</h2>
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

                <div class="table-responsive">
                  <table class="table table-bordered" id="tablaPagos">
                    <thead>
                      <tr>

                        <th>ID de pago</th>
                        <th>Nombres</th>
                        <th>Apellido Paterno</th>
                        <th>Fecha</th>
                        <th>Mes correspondiente</th>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                        
                      </tr>
                    </thead>
                    <tbody id="datos-contratos">
                      <?php
                      if ($Accion_pagina == 'NuevoPago')
                      {
                        if ($datos->num_rows())
                         {
                          foreach ($datos->result() as $row) { ?>
                            <tr>
                            <td><?php echo $row->ID_pago ?></td>
                            <td><?php echo $row->nombres ?></td>  
                            <td><?php echo $row->Apellido_p ?></td>
                            <td><?php echo $row->Fecha ?></td>
                            <td><?php echo $row->MesCorrespondiente ?></td>
                            <td><?php echo $row->Descripcion ?></td>
                            <td><?php echo $row->Monto ?></td>
                              <td>
                                <a data-id="<?php echo $row->ID_pago ?>" data-acction="editar" href="<?php echo site_url('/pagoEmpleados/editar_pago_empleado?id=').$row->ID_pago ?>" class="btn btn-info btn-xs"> Editar <i class="fas fa-pencil-alt"></i></a>
                                <a data-id="<?php echo $row->ID_pago ?>" data-acction="borrar" value="<?php echo site_url('/pagoEmpleados/EliminarPagoEmpleado') ?>" class="btn btn-danger btn-xs"> Borrar <i class="far fa-trash-alt"></i></a>
                              </td>
                            </tr>
                          <?php }
                        }
                       }
                    ?>
                    </tbody>
                  </table>
                </div> <!-- Tabla responsiva-->
              </div>
            </div>
      </div>
      
    </div>
  </div>

</div>