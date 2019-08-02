     <!-- page content -->
     <div class="right_col" role="main">
         <div class="">
             <div class="row top_tiles">
                 <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                         <div  class="icon"><i class="fa fa-user"></i>  </div>
                         <div class="count"><?php echo $empleados->num_rows();?></div>
                         <h3>Empleados Activos</h3>
                         <a href="<?php echo site_url("Empleado/index")?>"> <p>Para mas informacion</p> </a>
                         
                     </div>
                 </div>
                 <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                         <div class="icon"><i class="fa fa-newspaper-o"></i></div>
                         <div class="count"><?php echo $contratos->num_rows();?></div>
                         <h3>Contratos de Empleados</h3>
                         <a href="<?php echo site_url("ContratoEmpleado/ContratoEmpleado")?>"> <p>Para mas informacion</p> </a>
                         </div>
                 </div>
                 <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                         <div class="icon"><i class="fa fa-money"></i></div>
                         <div class="count"><?php echo $pago->Monto;?> Bs</div>
                         <h3>Pagos Realizados del mes</h3>
                         <a href="<?php echo site_url("pagoEmpleados/pagoEmpleado")?>"> <p>Para mas informacion</p> </a>
                     </div>
                 </div>
                
             </div>
         </div>
     </div>
     <!-- /page content -->