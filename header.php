<?php if(!$this->session->userdata('saeree_login') or $this->session->userdata('saeree_login') == "") header("Location:/?") ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SK-Works</title>
    
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/css/AdminLTE.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/skin-saeree.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/iCheck/flat/blue.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/morris/morris.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/datepicker/datepicker3.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/iCheck/minimal/grey.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/select2.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/pace/pace.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css')?>" />
    <link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="<?=base_url('assets/img/icon.png')?>"/>

    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jQueryUI/jquery-ui.min.js')?>"></script>
    
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/daterangepicker/moment.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>

    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/sparkline/jquery.sparkline.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
    <script src="<?=base_url('assets/plugins/knob/jquery.knob.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datepicker/bootstrap-datepicker-th.js')?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/fastclick/fastclick.js')?>"></script>
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/select2/select2.full.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/select2/select2.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/pace/pace.min.js')?>"></script>
    <script src="<?=base_url('assets/js/app.min.js')?>"></script>
    <script src="<?=base_url('assets/js/javascript.js')?>"></script>
    
    <script type="text/javascript">
      $(document).ready(function(e) {
        $(document).ajaxStart(function() { Pace.restart(); });
        $('a#btnLogout').click(function(e) {
          e.preventDefault();
          if(window.confirm("ต้องการออกจากระบบใช่หรือไม่")){
            $.ajax({
              url: $('body').attr('data-siteurl')+"/UserProcess/Logout",
            }).done(function($data) {
              if($data == ""){
                location.reload();
              }else{
                alert($data);
              }
            });
          }
        });
        $('.main-sidebar').mouseover(function(event) {
          $('body').removeClass('sidebar-collapse');
        });
        $('.content-wrapper').click(function(event) {
          $('body:not(.sidebar-collapse)').addClass('sidebar-collapse');
        });
      });
    </script>

    <style>
    
    @font-face {
          font-family: THSarabun;src: url(<?= base_url('assets/fonts/THSarabun.ttf')?>);
        }
		.THSarabun{font-family: THSarabun;font-size: 18px;line-height: 40px;}


		@font-face {font-family: supermarket;src: url(<?= base_url('assets/fonts/supermarket.ttf')?>);}
		
		.supermarket{
			font-family: supermarket;font-size: 18px;line-height: 40px;
		}

		@font-face {font-family: Sarabun-Regular;src: url(<?= base_url('assets/fonts/Sarabun-Regular.ttf')?>);}
		
		.Sarabun-Regular{
			font-family: Sarabun-Regular;
    }

    </style>

  </head>
