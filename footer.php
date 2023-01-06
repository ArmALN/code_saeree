
</div>
<footer class="main-footer Sarabun-Regular">
    <div class="pull-right hidden-xs">
        <b>SK-Works</b> V.1
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> SK-Works</a>.</strong> All rights
    reserved.
</footer>

<div class="control-sidebar-bg"></div>
</div>
<div class="modal" id="loaddingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <h2><i class="fa fa-spinner loadding"></i> <span class="Sarabun-Regular">ระบบกำลังประมวลผลข้อมูลกรุณารอสักครู่</span> </h2>
                </center>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(window).bind('beforeunload', function () {
            Pace.restart();
            setTimeout(function () {
                $('#loaddingModal').modal({
                    show: true,
                    keyboard: false,
                    backdrop: false
                });
            }, 500);
        });
        $('body').delegate('a.sidebar-toggle', 'click', function (e) {
            if ($('body').hasClass('sidebar-collapse')) {
                data = "collapse=";
            } else {
                data = "collapse=sidebar-collapse";
            }
            $.post($('body').attr('data-siteurl') + '/Func/setCollapse', data, function ($data) {
               
            });
        });
    });
</script>
</body>
</html>
