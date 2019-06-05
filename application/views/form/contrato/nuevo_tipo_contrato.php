
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
                    <form method="post" 
                          id="<?php if ($Accion_pagina == 'NuevoTipoContrato'){
                                        echo 'nuevo_tipo_contrato';
                                        } else {
                                          echo 'editar_tipo_contrato';
                                        }
                                 ?>"
                          <?php if ($Accion_pagina == 'EditarTipoContrato')
                            { /*echo 'action = "'.site_url('/Contrato/editar_tipo_contrato').'"';*/}  
                          ?>
                          data-parsley-validate 
                          class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipoContrato">Tipo de Contrato <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type="text" 
                                  id="tipoContrato"
                                  value = "<?php if ($Accion_pagina == 'EditarTipoContrato')
                                                    { echo $datos->Descripcion;} 
                                          ?>" 
                                  name="tipoContrato"
                                  required="required" 
                                  class="form-control col-md-7 col-xs-12" 
                                  placeholder = "Introdusca el tipo de Contrato 'Conductor', 'Ayudante', 'Contador'">
                        </div>
                      </div> 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary"
                                  <?php  if ($Accion_pagina == 'EditarTipoContrato'){ 
                                           echo 'href = "'.site_url("Contrato/tipocontrato").'"';
                                          }
                                  ?> 
                                  type="button"> <?php  if ($Accion_pagina == 'EditarTipoContrato'){ 
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
                                  <?php if($Accion_pagina == 'EditarTipoContrato'){
                                    echo 'id_data = "'.$datos->ID_tipoContrato.'"';
                                  } ?>
                                  value="<?php if ($Accion_pagina == 'NuevoTipoContrato'){ 
                                                  echo site_url('/Contrato/ingresar_tipo_contrato');
                                                } else {
                                                  echo site_url('/Contrato/editar_tipo_contrato');
                                                  } ?>" 
                                  class="btn btn-success"> <?php  if ($Accion_pagina == 'EditarTipoContrato'){ 
                                                                      echo "Editar";
                                                                  }
                                                                  else {
                                                                    echo "Guardar";
                                                                  } 
                                                              ?>
                          </button>
                        </div>
                      </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Boardered table <small>Contratos</small></h2>
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
                              if ($Accion_pagina == 'NuevoTipoContrato'){
                                if($datos->num_rows()){ 
                                  foreach ($datos->result() as $row){ ?>
                                    <tr>
                                      <th scope="row"><?php echo $row->ID_tipoContrato ?></th>
                                      <td><?php echo $row->Descripcion ?></td>
                                      <td>
                                        <a data-id = "<?php echo $row->ID_tipoContrato ?>" data-acction = "editar" href="<?php echo site_url('/Contrato/editar_tipo_contrato?id=').$row->ID_tipoContrato ?>" class="btn btn-info btn-xs"><i class="fas fa-pencil-alt"></i> Edit </a>
                                        <a data-id = "<?php echo $row->ID_tipoContrato ?>" data-acction = "borrar" value="<?php echo site_url('/Contrato/eliminar_tipo_Contrato') ?>" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i> Delete </a>
                                      </td>                           
                                    </tr>
                                  <?php }
                                } 
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
  
