
<head>

<style>

    .pageNumber
    {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #000;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #d2d6de;
        border-radius: 5px;
        margin-right: 5px;
    }

    button.active
    {
        color: #fff;
        cursor: default;
        background-color: #343a40;
        border-color: #343a40;
    }

    .select{
        background-color: #4d72df;
        color: white;
    }

</style>

<?php 
    $arrow_down = '&#129147;';
    $arrow_up = '&#129145;';
    $arrow_left = '&#129144;';
    $arrow_right = '&#129146;';

?>
<div class="content-wrapper">
    <?php 

    $data['data_breadcrumb'] = array();
    $data['data_breadcrumb'] = array(
        "Link" => 'SignV2/packing_loaddata',
        "Name" => 'ป้ายสินค้า',
        "Action" => 'ดึงข้อมูลตามสถานะ'
    );

    $this->load->view('Tools/Breadcrumb-2',$data); 
    ?>
    <?php $this->load->view('Tools/Panel-message-1'); ?>

    <section class="content">
        <div class="card">
            <div class="card-header bg-olive">
                <h2 class="card-title">เลือกการดึงข้อมูล</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">ค้นหาตามสถานะป้าย</label>
                            <select id="search_status_sign" class="form-control">
                                <option value="">ค้นหาตามสถานะป้าย</option>
                                <option value="1">รอสั่งทำ</option>
                                <option value="2">รอรับป้าย</option>
                                <option value="3">รอติดตั้งป้าย</option>
                                <option value="4">รอทำลาย</option>
                                <option value="5">รอตรวจสอบ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">ค้นหาผู้บันทึก</label>
                            <select name="search_creator[]" id="search_creator" class="form-control" placeholder="เลือกรายชื่อพนักงาน" multiple>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">ค้นหาตามกลุ่มสินค้า</label>
                            <select name="search_groupcode[]" id="search_groupcode" class="form-control" multiple>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="btn_loaddata"><i class="fa fa-search"></i> ดึงข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-success btn-block" id="btn_downloadExcel"><i class="fa fa-file-excel"></i> ดาวน์โหลด Excel</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-info btn-block" id="btn_printbar"><i class="fa fa-barcode"></i> แสดงบาร์โค้ดเลขที่เอกสาร</button>
                </div>
            </div>
        </div>

        <div class="card card-success card-outline">
            <div class="card-header">
                <h4>รายการป้าย</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover " id="table_data">
                    <thead>
                        <tr>
                            <th colspan="7" id="title_tb"></th>
                        </tr>
                        <tr>
                            <th>เลขที่เอกสาร</th>
                            <th>กลุ่มสินค้า</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>สาเหตุ</th>
                            <th>ผู้บันทึก</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_signloaddata">

                    </tbody>
                </table>
            </div>
        </div>

        <!-- <div class="card ">
            <div class="card-header bg-secondary">
                <h2 class="card-title">เลือกรูปแบบการปริ้นป้าย</h2>
            </div>
            <div class="card-body">
            </div>
        </div> -->
    </section>
</div>
