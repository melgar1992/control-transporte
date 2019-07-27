<!DOCTYPE html>
<html lang="en">

  <?php
      if (isset($this->session->userdata['logged_in'])) {
          $username = ($this->session->userdata['logged_in']['username']);
          $url_img = ($this->session->userdata['logged_in']['url_img']);
      } else {
          header("location: index.php/inicio/login");
      }
      
  ?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php img('images/favicon.ico') ?>" type="image/ico" />

    <title>Control de transporte El Oso! | </title>

    <!-- Bootstrap -->
    <?php css('/vendors/bootstrap/dist/css/bootstrap.min.css') ?>
    <!-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <?php css('/vendors/font-awesome/css/font-awesome.min.css') ?>
    <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- NProgress -->
    <?php css('/vendors/nprogress/nprogress.css') ?>
    <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->
    <!-- iCheck -->
    <?php css('/vendors/iCheck/skins/flat/green.css') ?>
    <!-- <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->
    <!-- DataTables -->
    <?php css('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>
	
    <!-- bootstrap-progressbar -->
    <?php css('/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') ?>
    <!-- <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> -->
    <!-- JQVMap -->
    <?php css('/vendors/jqvmap/dist/jqvmap.min.css') ?>
    <!-- <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> -->
    <!-- bootstrap-daterangepicker -->
    <?php css('/vendors/bootstrap-daterangepicker/daterangepicker.css') ?>
    <!-- <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> -->

    <!-- Custom Theme Style -->
    <?php css('/build/css/custom.min.css') ?>
    <!-- <link href="../build/css/custom.min.css" rel="stylesheet"> -->
    
    
  </head>