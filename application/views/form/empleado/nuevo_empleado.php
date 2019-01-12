
        <div class="right_col" role="main">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registro de Conductor <small>-</small></h2>
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
                  <form method="post" id="nuevo_empleado"  data-parsley-validate class="form-horizontal form-label-left" novalidate> <!--value="<?php //echo site_url('/form/conductor/ingresar_conductor') ?>" -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CI">CI <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="CI" name="CI"required="required" class="form-control col-md-7 col-xs-12" placeholder = "Número de Carnet de Identidad">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nombres" name = "nombres" required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido-paterno">Apellido Paterno <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="apellido-paterno" name="apellido-paterno" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido-materno">Apellido Materno <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="apellido-materno" name="apellido-materno" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                                                                                                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-nacimiento">Fecha de Nacimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class='input-group date' id='myDatepicker2'>
                            <input type='date' class="form-control" id="fecha-nacimiento" name="fecha-nacimiento"/>                                        
                          </div>
                        </div>
                      </div> 

                      <div class="form-group">
                        <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="direccion" id="direccion" class="form-control" rows="3" placeholder="Dirección" required="required"></textarea>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="departamento" class="control-label col-md-3 col-sm-3 col-xs-12">Departamento *:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="departamento" name="departamento" class="form-control" required>
                            <option value=""></option>
                            <option value="Pando">Pando</option>
                            <option value="Beni">Beni</option>
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="Cochabamba">Cochabamba</option>
                            <option value="La Paz">La Paz</option>
                            <option value="Sucre">Sucre</option>
                            <option value="Potosi">Potosi</option>
                            <option value="Tarija">Tarija</option>
                            <option value="Oruro">Oruro</option>
                          </select>
                        </div>  
                      </div>

                      <div class="form-group">
                        <label for="telefono_01" class="control-label col-md-3 col-sm-3 col-xs-12">Telefono 01 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="telefono_01"  class="form-control col-md-7 col-xs-12" type="number" name="telefono_01" required="required" placeholder = "77800975-34622503">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="telefono_02" class="control-label col-md-3 col-sm-3 col-xs-12">Telefono 02 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="telefono_02"  class="form-control col-md-7 col-xs-12" type="number" name="telefono_02" required="required" placeholder = "77800975-34622503">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="calificacion" class="control-label col-md-3 col-sm-3 col-xs-12">Calificación <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="calificacion" class="form-control col-md-7 col-xs-12" type="number" name="calificacion" required="required" placeholder = "Calificación del Conductor" min="1" max="10">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Una brever descripción del conductor" required="required"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tipo-licencia" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de licencia <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="tipo-licencia" name="tipo-licencia" class="form-control" required>
                            <option value=""></option>
                            <option value="Motociclista">Motociclista</option>
                            <option value="Particular">Particular</option>
                            <option value="Profecional A">Profecional A</option>
                            <option value="Profecional B">Profecional B</option>
                            <option value="Profecional C">Profecional C</option>
                            <option value="Motorista T">Motorista T</option>
                          </select>
                        </div>  
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-vencimiento-l">Fecha de Vencimiento Licencia <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class='input-group date' id='myDatepicker2'>
                            <input type='date' class="form-control" id ="fecha-vencimiento-l" name="fecha-vencimiento-l" />                                        
                          </div>
                        </div>
                      </div>     

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancelar</button>              
                          <button class="btn btn-primary" type="reset">Borrar</button>
                          <button type="submit" id="tipo" value="<?php echo site_url('/form/Empleado/ingresar_empleado') ?>" class="btn btn-success">Guardar</button>
                        </div>
                      </div>

                      <br>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Boardered table <small>Conductores</small></h2>
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
                          <table class="table table-bordered" id="tablaEmpleados">
                            <thead>
                              <tr>
                                <th>ID Empleado</th>
                                <th>CI</th>
                                <th>Nombres</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Teléfono 01</th>
                                <th>Departamento</th>
                                <th>Tipo de Licencia</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>
                            <tbody> 
                              <?php
                                if($datos->num_rows()){
                                  foreach ($datos->result() as $row){ ?>
                                    <tr>
                                    <th scope="row"><?php echo $row->ID_empleado ?></th>
                                    <td><?php echo $row->CI ?></td>
                                    <td><?php echo $row->Nombres ?></td>
                                    <td><?php echo $row->Apellido_p ?></td>
                                    <td><?php echo $row->Apellido_m ?></td>   
                                    <td><?php echo $row->Fecha_nacimiento ?></td>
                                    <td><?php echo $row->Telefono_01 ?></td>
                                    <td><?php echo $row->Departamento ?></td>
                                    <td><?php echo $row->TipoLicencia ?></td>                                    
                                    <td>
                                      <a href="#" class="btn btn-info btn-xs"> Edit <i class="fas fa-pencil-alt"></i></a>
                                      <a href="#" class="btn btn-danger btn-xs"> Delete <i class="far fa-trash-alt"></i></a>
                                    </td>                           
                                  </tr>                                                    
                                  <?php }
                                }
                              ?>                   
                            </tbody>
                          </table>
                        </div> <!-- Tabla responsiva-->
                      </div> <!-- contenedor Tabla -->
                    </div>
                  </div> <!-- Contenedor de toda la tabla -->
                  </form>                  
                </div>
              </div>       

              </div>
            </div>
        </div>
  


