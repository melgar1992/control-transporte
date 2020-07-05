<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Control de Transporte Melgar! | </title>

  <!-- Bootstrap -->
  <?php css('/vendors/bootstrap/dist/css/bootstrap.min.css') ?>
  <!-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <?php //css('/vendors/font-awesome/css/font-awesome.min.css') 
  ?>
  <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
  <!-- NProgress -->
  <?php css('/vendors/nprogress/nprogress.css') ?>
  <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->
  <!-- Animate.css -->
  <?php css('/vendors/animate.css/animate.min.css') ?>
  <!-- <link href="../vendors/animate.css/animate.min.css" rel="stylesheet"> -->

  <!-- Custom Theme Style -->
  <?php css('/build/css/custom.min.css') ?>
  <!-- <link href="../build/css/custom.min.css" rel="stylesheet"> -->
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="post" id="Formulario" action="<?php echo site_url('BaseController/user_login_process') ?>">
            <h1>Iniciar sesión</h1>
            <?php if ($this->session->flashdata("error")) : ?>
              <div class="alert alert-danger">
                <p><?php echo $this->session->flashdata("error"); ?></p>
              </div>
            <?php endif; ?>
            <div>
              <input type="text" id="usr" name="username" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="password" id="pass" name="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <button type="submit" class="btn btn-default submit">Log in</button>

            </div>

            <div class="clearfix"></div>

            <div class="separator">

              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fas fa-truck-moving"></i></i></i> Control de Transporte</h1>
                <p>©2020 Todos los derechos reservados. Control de transporte Melgar! </p>
              </div>
            </div>
          </form>
        </section>
      </div>

      <!-- <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" id="Registro" action="<?php //echo site_url('BaseController/new_user_registration') 
                                                      ?>">
              <h1>Create Account</h1>
              <div>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="text" id="privilegio" name="privilegio" class="form-control" placeholder="Privilegio" required="" />
              </div>
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" >Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />                

                <div>
                  <h1><i class="fas fa-truck-moving"></i></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>                
              </div>
            </form>
          </section>
        </div> -->
      <div class="clearfix"><?php echo validation_errors(); ?></div>
    </div>
  </div>

  <div id="dialogo-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p>Usuario inválido. Intente de nuevo.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


</body>
<?php script('vendors/jquery/dist/jquery.min.js') ?>
<?php script('vendors/bootstrap/dist/js/bootstrap.min.js') ?>
<?php script('custom.js') ?>


</html>
<script>
  /* 	$(document).ready(function(){
		frmAccion("#Formulario",function(res) {
			if(res.ok){
				location.reload();
			}else{
				$('#pass').val('')
				$('#dialogo-modal').modal('show')
				//location.reload();
			}
		})
	});*/
</script>