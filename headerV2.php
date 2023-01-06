<?php if(!$this->session->userdata('saeree_login') or $this->session->userdata('saeree_login') == "") header("Location:/?") ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SK-GROUP</title>
   
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE3/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE3/dist/css/adminlte.min.css')?>">
    <!-- jquery-ui -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins/jquery-ui/jquery-ui.min.css')?>">
     <!-- sweetalert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins_other/sweetalert2/dist/sweetalert2.min.css')?>">
    <!-- Pace -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins/pace-progress/themes/red/pace-theme-flat-top.css')?>">
    <!-- toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins/toastr/toastr.min.css')?>">
    <!-- intro -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins_other/intro/introjs.min.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins_other/intro/themes/introjs-flattener.css')?>">
    <!-- select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins/select2/css/select2.min.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
    

    <style>

      @font-face {
        font-family: Kanit-Regular;src: url(<?= base_url('assets/AdminLTE3/fonts/Kanit/Kanit-Regular.ttf')?>);
      }
      .Kanit-Regular{
        font-family: Kanit-Regular;
      }

      @font-face {
        font-family: Sarabun-Regular;src: url(<?= base_url('assets/AdminLTE3/fonts/Sarabun/Sarabun-Regular.ttf')?>);
      }
      .Sarabun-Regular{
        font-family: Sarabun-Regular;
      }

      @font-face {
        font-family: BungeeShade-Regular;src: url(<?= base_url('assets/AdminLTE3/fonts/Bungee_Shade/BungeeShade-Regular.ttf')?>);
      }
      .BungeeShade-Regular{
        font-family: BungeeShade-Regular;
      }

      .hidden {
        display:none;
      }

      .swal2-popup {
          font-family: Sarabun-Regular;src: url(<?= base_url('assets/AdminLTE3/fonts/Sarabun/Sarabun-Regular.ttf')?>);
      }

      .swal2-icon.swal2-warning {
          font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
          color: #f6c23e;
          border-color: #f6c23e;
          font-size: 60px;
          line-height: 80px;
          text-align: center;
      }

      .introjs-helperNumberLayer {
          font-size: 14px;
          text-shadow: none;
          width: 22px;
          height: 22px;
          line-height: 22px;
          border: 2px solid #ecf0f1;
          border-radius: 20%;
          background: #343a40;
      }

      .back-to-top {
        bottom: 4.25rem;
        position: fixed;
        right: 1.25rem;
        z-index: 1032;
      }

      .select2-container--bootstrap4.select2-container--focus .select2-selection {
        border-color: #000;
        webkit-box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
      }

      .select2 {
        width:100%!important;
      }

    </style>
    
  </head>

  <body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed Sarabun-Regular" data-siteurl="<?= site_url() ?>">
  
    <div class="wrapper">

      



