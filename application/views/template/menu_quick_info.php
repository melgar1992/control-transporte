  <body class="nav-md">
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="<?php echo site_url() ?>" class="site_title"><i class="fas fa-truck-moving"></i> <span>Trans Melgar!</span></a>
              </div>
  
              <div class="clearfix"></div>
  
              <!-- menu profile quick info -->
              <div class="profile clearfix">
                <div class="profile_pic">
                </div>
                <div class="profile_info">
                  <span>Bienvenido,</span>
                  <h2><?php 
                          if (isset($this->session->userdata['logged_in'])){
                            echo  $this->session->userdata['logged_in']['username'];}
                            ?>
                    </h2>
                </div>
              </div>
              <!-- /menu profile quick info -->
 
              <br />