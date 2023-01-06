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
            "Action" => 'เพิ่ม'
        );

        $this->load->view('Tools/Breadcrumb-2',$data); 

    ?>

    <section class="content">
        <div class="container-fluid">

            <h5 class="mb-2">ประเภทงาน</h5>

            <div class="row ">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php $this->load->view('Request_production/tools/Card-doc-type-2'); ?>
                    </div>
                </div>

                <div class="col-md-8" id="row_fixhistory" name="row_fixhistory">
                    <div class="form-group">
                        <?php $this->load->view('Request_production/tools/Card-doc-history-1'); ?>
                    </div>
                </div>
            </div>

            <h5 class="mb-2" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>

            <h5 class="mb-2">รายละเอียด</h5>

            <div class="row ">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php $this->load->view('Request_production/tools/Card-detail-2'); ?>
                    </div>
                </div>
            </div>

            <h5 class="mb-2" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>


            <h5 class="mb-2">ค่าบริการ</h5>

            <div class="row ">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php $this->load->view('Request_production/tools/Card-labor-2'); ?>
                    </div>
                </div>
            </div>

            <h5 class="mb-2" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>


            <h5 class="mb-2">ค่าวัสดุ</h5>

            <?php $this->load->view('Request_production/tools/Card-item-2'); ?>

            <!-- <h5 class="mb-2">สรุป</h5> -->

            <h5 class="mb-2" style="font-size: 50px; color: #dee2e6;"><i class="fas fa-angle-double-down"></i></h5>

            <div class="row" style="margin-bottom: 5%;">
                <div class="col-md-12 ">
                    <button type="submit" class="btn btn-success  float-right "
                        id="btn_add_submit">บันทึกข้อมูล</button>

                    <div class="btn-group float-right mr-2">
                        <button type="button" class="btn btn-info ">รวมราคาค่าบริการ</button>
                        <button type="button" class="btn btn-info " id="sum_labor">0.00</button>
                        <button type="button" class="btn btn-info ">รวมราคาค่าวัสดุ</button>
                        <button type="button" class="btn btn-info " id="sum_item">0.00</button>
                        <button type="button"
                            class="btn btn-secondary ">รวมราคาต้นทุนผลิต-ต้นทุนซ่อมทั้งหมด(ประมาณการ)</button>
                        <button type="button" class="btn btn-secondary " id="field_rp_cost_estimate">0.00</button>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>