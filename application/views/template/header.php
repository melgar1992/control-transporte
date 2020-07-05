<!DOCTYPE html>
<html lang="en">

<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $url_img = ($this->session->userdata['logged_in']['url_img']);
} else {
    redirect(site_url() . '/inicio/login');
}

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php img('images/truck-moving-solid.svg') ?>" type="svg" />

    <title>Control de transporte Melgar| </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" integrity="sha256-AIodEDkC8V/bHBkfyxzolUMw57jeQ9CauwhVW6YJ9CA=" crossorigin="anonymous" />
    <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->
    <!-- DataTables -->
    <?php css('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>
    <!-- bootstrap-progressbar -->
    <?php css('/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') ?>
    <!-- <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> -->
    <!-- <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> -->
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" integrity="sha256-VVbO1uqtov1mU6f9qu/q+MfDmrqTfoba0rAE07szS20=" crossorigin="anonymous" />
    <!-- <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> -->
    <!-- Custom Theme Style -->
    <?php css('/build/css/custom.min.css') ?>
    <!-- <link href="../build/css/custom.min.css" rel="stylesheet"> -->
    <!-- Estilos de migue -->
    <?php css('/build/css/migue.css') ?>
    <!-- <link href="../build/css/custom.min.css" rel="stylesheet"> -->


</head>