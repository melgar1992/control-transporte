        <!-- footer content -->
        <footer>
          <div class="pull-right">
            DataZoom - Control de transporte Melgar!
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        </div>
        </div>

        <!-- jQuery -->
        <?php script('/vendors/jquery/dist/jquery.min.js') ?>
        <!-- jQuery UI -->
        <?php script('/vendors/jquery-ui/jquery-ui.js') ?>
        <!-- <script src="../vendors/jquery/dist/jquery.min.js"></script> -->
        <!-- Bootstrap -->
        <?php script('/vendors/bootstrap/dist/js/bootstrap.min.js') ?>
        <!-- <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script> -->
        <!-- FastClick -->
        <?php script('/vendors/fastclick/lib/fastclick.js') ?>
        <!-- <script src="../vendors/fastclick/lib/fastclick.js"></script> -->
        <!-- Chart.js -->
        <?php script('/vendors/Chart.js/dist/Chart.min.js') ?>
        <!-- <script src="../vendors/Chart.js/dist/Chart.min.js"></script> -->
        <!-- bootstrap-progressbar -->
        <?php script('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>
        <!-- <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> -->
        <!-- iCheck -->
        <?php script('/vendors/iCheck/icheck.min.js') ?>
        <!-- <script src="../vendors/iCheck/icheck.min.js"></script> -->
        <!-- DateJS -->
        <?php script('/vendors/DateJS/build/date.js') ?>
        <!-- <script src="../vendors/DateJS/build/date.js"></script> -->

        <!-- bootstrap-daterangepicker -->
        <?php script('/vendors/moment/min/moment.min.js') ?>
        <!-- <script src="../vendors/moment/min/moment.min.js"></script> -->
        <?php script('/vendors/bootstrap-daterangepicker/daterangepicker.js') ?>
        <!-- <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script> -->
        <!-- bootstrap-datetimepicker -->
        <?php script('/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>
        <!-- <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script> -->

        <!-- jquery.inputmask -->
        <?php script('/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') ?>
        <!-- <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script> -->

        <!-- DataTables -->
        <?php script('/vendors/datatables.net/js/jquery.dataTables.min.js') ?>
        <?php script('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>

        <!-- Data Tables export -->
        <?php script('/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') ?>
        <?php script('/vendors/datatables.net-buttons/js/buttons.colVis.min.js') ?>
        <?php script('/vendors/datatables.net-buttons/js/buttons.flash.min.js') ?>
        <?php script('/vendors/datatables.net-buttons/js/buttons.html5.min.js') ?>
        <?php script('/vendors/datatables.net-buttons/js/buttons.print.min.js') ?>
        <?php script('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>
        
        <!-- Jquery Print, sirve para imprimir -->
        <?php script('/vendors/jquery-print/jquery.print.js') ?>
        <!-- PNotify -->
        <?php script('/vendors/pnotify/dist/pnotify.js') ?>
        <?php script('/vendors/pnotify/dist/pnotify.buttons.js') ?>
        <?php script('/vendors/pnotify/dist/pnotify.nonblock.js') ?>


        <!-- Custom Theme Scripts -->
        <!-- <script src="../build/js/custom.min.js"></script> -->
        <!-- Calendario -->
        <?php script('/build/js/custom.min.js') ?>
        <?php script('/vendors/fullcalendar/dist/fullcalendar.min.js') ?>

        <!-- formulario -->
        <?php
        if (isset($pagina)) {
          script('js' . $pagina . '.js');
        }

        ?>
        <input type="hidden" value="<?php echo site_url(); ?>" id="base_url">
        <script>
          var base_url = $("#base_url").val();

          function mayus(e) {
            e.value = e.value.toUpperCase();
          }
        </script>
        <!-- sweetalert -->
        <?php script('sweetalert2.all.min.js') ?>



        </body>

        </html>