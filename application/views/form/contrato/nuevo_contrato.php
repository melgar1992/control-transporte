
        <div class="right_col" role="main">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Nuevo Contrato <small>-</small></h2>
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
                    <form method="post" id="nuevo_contrato"  data-parsley-validate class="form-horizontal form-label-left"> <!--value="<?php //echo site_url('/form/conductor/ingresar_conductor') ?>" -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipoContrato">Tipo de Contrato <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tipoContrato" name="tipoContrato"required="required" class="form-control col-md-7 col-xs-12" placeholder = "Introdusca el tipo de Contrato 'Conductor', 'Ayudante', 'Contador'">
                        </div>
                      </div> 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancelar</button>              
                          <button class="btn btn-primary" type="reset">Borrar</button>
                          <button type="submit" id="tipo" value="<?php echo site_url('/form/Contrato/ingresar_contrato') ?>" class="btn btn-success">Guardar</button>
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
                          <table class="table table-bordered" id="tablaContrato">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Tipo de Contrato</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Conductor</td>
                                <td>
                                  <a href="#" class="btn btn-info btn-xs"><i class="fas fa-pencil-alt"></i> Edit </a>
                                  <a href="#" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i> Delete </a>
                                </td>                           
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>Ayudante</td>
                                <td>
                                  <a href="#" class="btn btn-info btn-xs"><i class="fas fa-pencil-alt"></i> Edit </a>
                                  <a href="#" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i> Delete </a>
                                </td>  
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>Administrador</td>
                                <td>
                                  <a href="#" class="btn btn-info btn-xs"><i class="fas fa-pencil-alt"></i> Edit </a>
                                  <a href="#" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i> Delete </a>
                                </td>  
                              </tr>
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
  
