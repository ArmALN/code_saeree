<head>

    <style>

    </style>

</head>

<div class="content-wrapper">

    <?php 

        $data['data_breadcrumb'] = array();
        $data['data_breadcrumb'] = array(
            "Link" => 'Request_production',
            "Name" => 'ใบสั่งผลิต - ใบสั่งซ่อม',
            "Action" => 'รายละเอียด'
        );

        $this->load->view('Tools/Breadcrumb-2',$data); 

    ?>

    <section class="content">
        <div class="container-fluid">

        <input type="hidden" class="data_rp_id" id="data_rp_id">

        <div class="row row_info" id="row_info">
            <div class="col-md-12">
                <div class="form-group">
                    <?php $this->load->view('Request_production/tools/Card-summary-info-2'); ?>
                </div>
            </div>
        </div>

        <h5 class="mb-2 row_history" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>

        <h5 class="mb-2 row_history">ประวัติ</h5>

        <div class="row row_history">

            <div class="col-md-6">
                <div class="form-group">
                    <?php $this->load->view('Request_production/tools/Card-doc-history-1'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php $this->load->view('Request_production/tools/Card-summary-history-2'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php //$this->load->view('Request_production/tools/Card-summary-progress-1'); ?>
                </div>
            </div>

        </div>

        <h5 class="mb-2 row_labor" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>

        <h5 class="mb-2 row_labor">ค่าบริการ</h5>

        <div class="row row_labor" id="row_labor">
            <div class="col-md-12">
                <div class="form-group">
                    <?php $this->load->view('Request_production/tools/Card-summary-labor-2'); ?>
                </div>
            </div>
        </div>

        <h5 class="mb-2 row_item" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>

        <h5 class="mb-2 row_item">ค่าวัสดุ</h5>

        <div class="row row_item" id="row_item">
            <div class="col-md-12">
                <div class="form-group">
                    <?php $this->load->view('Request_production/tools/Card-summary-item-2'); ?>
                </div>
            </div>
        </div>

        <h5 class="mb-2 row_summary" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>

        <h5 class="mb-2 row_summary">สรุป</h5>

        <?php $this->load->view('Request_production/tools/Card-summary-summary-2'); ?>

        </div>

        <!-- <h5 class="mb-2 row_print" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>

        <h5 class="mb-2 row_print">พิพม์</h5>

        <div class="row row_print">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="card  card-solid ">
                        <div class="card-body">
                            <div class="row" id="row_print">
                                <div class="col-md-4">
                                    <div class="card card-solid text-center">
                                        <div class="card-header">
                                            <h4>ค่าบริการ</h4>
                                        </div>
                                        <div class="card-body">
                                            <button class="btn btn-primary" id="btn_print_labor">พิพม์ <i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-solid text-center">
                                        <div class="card-header">
                                            <h4>ค่าวัสดุ</h4>
                                        </div>
                                        <div class="card-body">
                                            <button class="btn btn-primary" id="btn_print_item">พิพม์ <i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-solid text-center">
                                        <div class="card-header">
                                            <h4>ค่าบริการและค่าวัสดุ</h4>
                                        </div>
                                        <div class="card-body">
                                            <button class="btn btn-primary" id="btn_print_all">พิพม์ <i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>

</div>
