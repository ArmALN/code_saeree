        <a id="back-to-top" href="#" class="btn btn-secondary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y'); ?> <a href="">SK-GROUP</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3
            </div>
        </footer>
        
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="<?=base_url('assets/AdminLTE3/plugins_other/jquery/jquery.min.js')?>"></script>
        <!-- jQuery UI -->
        <script src="<?=base_url('assets/AdminLTE3/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
        <!-- Bootstrap -->
        <script src="<?=base_url('assets/AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <!-- overlayScrollbars -->
        <script src="<?=base_url('assets/AdminLTE3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/AdminLTE3/dist/js/adminlte.js')?>"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="<?=base_url('assets/AdminLTE3/dist/js/demo.js')?>"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="<?=base_url('assets/AdminLTE3/plugins/jquery-mousewheel/jquery.mousewheel.js')?>"></script>
        <script src="<?=base_url('assets/AdminLTE3/plugins/raphael/raphael.min.js')?>"></script>
        <script src="<?=base_url('assets/AdminLTE3/plugins/jquery-mapael/jquery.mapael.min.js')?>"></script>
        <script src="<?=base_url('assets/AdminLTE3/plugins/jquery-mapael/maps/usa_states.min.js')?>"></script>
        <!-- ChartJS -->
        <script src="<?=base_url('assets/AdminLTE3/plugins/chart.js/Chart.min.js')?>"></script>

        <!-- PAGE SCRIPTS -->
        <!-- <script src="<?=base_url('assets/AdminLTE3/dist/js/pages/dashboard2.js')?>"></script> -->

        <!-- sweetalert2 -->
        <script src="<?= base_url('assets/AdminLTE3/plugins_other/sweetalert2/dist/sweetalert2.min.js')?>" ></script>

        <!-- Pace -->
        <script src="<?= base_url('assets/AdminLTE3/plugins/pace-progress/pace.min.js')?>" ></script>
        <!-- toastr -->
        <script src="<?= base_url('assets/AdminLTE3/plugins/toastr/toastr.min.js')?>" ></script>
         <!-- toastr -->
         <script src="<?= base_url('assets/AdminLTE3/plugins_other/intro/intro.min.js')?>" ></script>
         <!-- select2 -->
         <script src="<?=base_url('assets/AdminLTE3/plugins/select2/js/select2.full.min.js')?>"></script>

        <!-- ekko -->
        <script src="<?= base_url('assets/AdminLTE3/plugins/ekko-lightbox/ekko-lightbox.min.js')?>" ></script>

        <!-- table2excel -->
        <script src="<?= base_url('assets/AdminLTE3/plugins_other/table2excel/jquery.table2excel.js')?>" ></script>

        <script src="<?= base_url('assets/plugins/export_csv/dist/table2csv.js')?>" ></script>

    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(e) {

        $(document).ajaxStart(function() { 
            Pace.restart(); 
        });
       
        $('a#btnLogout').click(function(e) {
            e.preventDefault();

            swal({
                title: 'ออกจากระบบ',
                text: "คุณต้องการออกจากระบบหรือไม่?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1CC88A',
                cancelButtonColor: '#E74A3B',
                confirmButtonText: 'ใช่ ,ฉัน ตกลง!',
                cancelButtonText: 'ปิด',
            }).then((result) => {
                if (result.value) {
                
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

        });
    });
</script>