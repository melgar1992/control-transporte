  <body class="nav-md">
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="index.html" class="site_title"><i class="fas fa-truck-moving"></i> <span>El Oso!</span></a>
              </div>
  
              <div class="clearfix"></div>
  
              <!-- menu profile quick info -->
              <div class="profile clearfix">
                <div class="profile_pic">
                  <img src="<?php 
                                if (isset($this->session->userdata['logged_in'])) {                                  
                                  img($this->session->userdata['logged_in']['url_img']);
                              }?>" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                  <span>Welcome,</span>
                  <h2><?php 
                          if (isset($this->session->userdata['logged_in'])){
                            echo  $this->session->userdata['logged_in']['username'];}
                            ?>
                    </h2>
                </div>
              </div>
              <!-- /menu profile quick info -->
 
              <br />