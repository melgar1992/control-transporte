
        
        <div class="right_col" role="main">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar de Conductor <small>-</small></h2>
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
                  <form method="post" id="editar_empleado" action="<?php echo site_url('/form/Empleado/editarEmpleado') ?>" data-parsley-validate class="form-horizontal form-label-left" novalidate> <!--value="<?php //echo site_url('/form/conductor/ingresar_conductor') ?>" -->
                  <input type="hidden" name="ID_persona" value="<?php echo $datos->ID_persona ?>" >
                  <input type="hidden" name="ID_empleado" value="<?php echo $datos->ID_empleado ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CI">CI <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type="text" 
                                  id="CI" 
                                  value="<?php echo $datos->CI ?>" 
                                  name="CI"
                                  required="required" 
                                  class="form-control col-md-7 col-xs-12" 
                                  placeholder = "Número de Carnet de Identidad">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type="text" 
                                  id="nombres"
                                  value="<?php echo $datos->Nombres ?>"
                                  name = "nombres" 
                                  required="required" 
                                  class="form-control col-md-7 col-xs-12" 
                          >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido-paterno">Apellido Paterno <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type="text" 
                                  id="apellido-paterno" 
                                  value="<?php echo $datos->Apellido_p ?>"
                                  name="apellido-paterno" 
                                  required="required" 
                                  class="form-control col-md-7 col-xs-12"
                          >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido-materno">Apellido Materno <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type="text" 
                                  id="apellido-materno" 
                                  value="<?php echo $datos->Apellido_m ?>"
                                  name="apellido-materno" 
                                  required="required" 
                                  class="form-control col-md-7 col-xs-12"
                          >
                        </div>
                      </div>
                                                                                                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-nacimiento">Fecha de Nacimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class='input-group date' id='myDatepicker2'>
                            <input  type='date'                                     
                                    id="fecha-nacimiento"
                                    value="<?php echo $datos->Fecha_nacimiento ?>" 
                                    class="form-control" 
                                    name="fecha-nacimiento"/>                                        
                          </div>
                        </div>
                      </div> 

                      <div class="form-group">
                        <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea   name="direccion" 
                                    id="direccion"                                    
                                    class="form-control" 
                                    rows="3" 
                                    placeholder="Dirección" 
                                    required="required"
                        ><?php echo $datos->Direccion ?></textarea>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="departamento" class="control-label col-md-3 col-sm-3 col-xs-12">Departamento *:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="departamento" name="departamento" class="form-control" required >
                            <option value=""></option>
                            <option value="Pando" <?php if($datos->Departamento =="Pando"){echo "selected";} ?>>Pando</option>
                            <option value="Beni" <?php if($datos->Departamento =="Beni"){echo "selected";} ?>>Beni</option>
                            <option value="Santa Cruz" <?php if($datos->Departamento =="Santa Cruz"){echo "selected";} ?>>Santa Cruz</option>
                            <option value="Cochabamba" <?php if($datos->Departamento =="Cochabamba"){echo "selected";} ?>>Cochabamba</option>
                            <option value="La Paz" <?php if($datos->Departamento =="La Paz"){echo "selected";} ?>>La Paz</option>
                            <option value="Sucre" <?php if($datos->Departamento =="Sucre"){echo "selected";} ?>>Sucre</option>
                            <option value="Potosi" <?php if($datos->Departamento =="Potosi"){echo "selected";} ?>>Potosi</option>
                            <option value="Tarija" <?php if($datos->Departamento =="Tarija"){echo "selected";} ?>>Tarija</option>
                            <option value="Oruro" <?php if($datos->Departamento =="Oruro"){echo "selected";} ?>>Oruro</option>
                          </select>
                        </div>  
                      </div>

                      <div class="form-group">
                        <label for="telefono_01" class="control-label col-md-3 col-sm-3 col-xs-12">Telefono 01 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  id="telefono_01"
                                  value="<?php echo $datos->Telefono_01 ?>"  
                                  class="form-control col-md-7 col-xs-12" 
                                  type="number" 
                                  name="telefono_01" 
                                  required="required" 
                                  placeholder = "77800975-34622503"
                          >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="telefono_02" class="control-label col-md-3 col-sm-3 col-xs-12">Telefono 02 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  id="telefono_02" 
                                  value = "<?php echo $datos->Telefono_02 ?>"
                                  class="form-control col-md-7 col-xs-12" 
                                  type="number" 
                                  name="telefono_02" 
                                  required="required" 
                                  placeholder = "77800975-34622503"
                          >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="calificacion" class="control-label col-md-3 col-sm-3 col-xs-12">Calificación <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  id="calificacion" 
                                  value="<?php echo $datos->Calificacion ?>"
                                  class="form-control col-md-7 col-xs-12" 
                                  type="number" 
                                  name="calificacion" 
                                  required="required" 
                                  placeholder = "Calificación del Conductor" 
                                  min="1" 
                                  max="10">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="descripcion" 
                                  id="descripcion" 
                                  class="form-control" 
                                  rows="3" 
                                  placeholder="Una brever descripción del conductor" 
                                  required="required"
                        ><?php echo $datos->Descripcion ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tipo-licencia" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de licencia <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="tipo-licencia" name="tipo-licencia" class="form-control" required>
                            <option value=""></option>
                            <option value="Motociclista" <?php if($datos->TipoLicencia =="Motociclista"){echo "selected";} ?>>Motociclista</option>
                            <option value="Particular" <?php if($datos->TipoLicencia =="Particular"){echo "selected";} ?>>Particular</option>
                            <option value="Profecional A" <?php if($datos->TipoLicencia =="Profecional A"){echo "selected";} ?>>Profecional A</option>
                            <option value="Profecional B" <?php if($datos->TipoLicencia =="Profecional B"){echo "selected";} ?>>Profecional B</option>
                            <option value="Profecional C" <?php if($datos->TipoLicencia =="Profecional C"){echo "selected";} ?>>Profecional C</option>
                            <option value="Motorista T" <?php if($datos->TipoLicencia =="Motorista T"){echo "selected";} ?>>Motorista T</option>
                          </select>
                        </div>  
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-vencimiento-l">Fecha de Vencimiento Licencia <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class='input-group date' id='myDatepicker2'>
                            <input  type='date' 
                                    value="<?php echo $datos->FechaVencimientoL ?>"
                                    class="form-control" 
                                    id ="fecha-vencimiento-l" 
                                    name="fecha-vencimiento-l" 
                            />                                        
                          </div>
                        </div>
                      </div>     

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancelar</button>
                          <button type="submit" name="button" value="editar" class="btn btn-success">Editar</button>
                        </div>
                      </div>                  
                  </form>   
                  <pre>
                  <?php 
                    var_dump($datos);        
                  ?>
                  </pre>               
                </div>
              </div>       

              </div>
            </div>
        </div>
        <script>
        
        </script>
  


